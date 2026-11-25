<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'CRM & Konsultasi';

    protected static ?int $navigationSort = 0;

    public static function getNavigationBadge(): ?string
    {
        $baru = Lead::where('status', 'baru')->count();

        return $baru > 0 ? (string) $baru : null;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Lead Konsultasi')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('brand_name')
                        ->label('Nama Usaha / Brand')
                        ->maxLength(150),
                    Forms\Components\Select::make('package_id')
                        ->label('Paket Dipilih')
                        ->relationship('package', 'name_id')
                        ->searchable()
                        ->preload(),
                    Forms\Components\Select::make('marketing_code_id')
                        ->label('Tim Marketing')
                        ->relationship('marketingCode', 'marketer_name')
                        ->searchable()
                        ->preload(),
                    Forms\Components\TextInput::make('promo_code')
                        ->label('Kode Promo Dipakai')
                        ->maxLength(50),
                    Forms\Components\Select::make('lang')
                        ->label('Bahasa')
                        ->options([
                            'id' => 'Indonesia (ID)',
                            'en' => 'English (EN)',
                        ])
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Status Lead')
                        ->options(Lead::statusOptions())
                        ->required(),
                    Forms\Components\Textarea::make('message')
                        ->label('Pesan WhatsApp')
                        ->rows(6)
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('ip_address')
                        ->label('Alamat IP')
                        ->disabled(),
                    Forms\Components\TextInput::make('user_agent')
                        ->label('User Agent')
                        ->disabled(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Masuk')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand_name')
                    ->label('Usaha / Brand')
                    ->placeholder('—')
                    ->searchable(),
                Tables\Columns\TextColumn::make('package.name_id')
                    ->label('Paket')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('marketingCode.marketer_name')
                    ->label('Marketing')
                    ->description(fn (Lead $record): ?string => $record->promo_code)
                    ->placeholder('Organik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lang')
                    ->label('Bahasa')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'baru' => 'info',
                        'dihubungi' => 'warning',
                        'deal' => 'success',
                        'batal' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('message')
                    ->label('Ringkasan Pesan')
                    ->limit(45)
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options(Lead::statusOptions()),
                Tables\Filters\SelectFilter::make('lang')
                    ->label('Bahasa')
                    ->options([
                        'id' => 'Indonesia (ID)',
                        'en' => 'English (EN)',
                    ]),
                Tables\Filters\SelectFilter::make('marketing_code_id')
                    ->label('Tim Marketing')
                    ->relationship('marketingCode', 'marketer_name'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('exportCsv')
                    ->label('Ekspor CSV')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('gray')
                    ->action(function (): StreamedResponse {
                        $filename = 'leads-bocahlabs-' . now()->format('Y-m-d') . '.csv';

                        return response()->streamDownload(function (): void {
                            $handle = fopen('php://output', 'w');
                            // BOM UTF-8 agar Excel Windows membaca karakter dengan benar
                            fwrite($handle, "\xEF\xBB\xBF");
                            fputcsv($handle, ['ID', 'Waktu', 'Brand', 'Paket', 'Bahasa', 'Status', 'IP', 'Pesan']);

                            Lead::with('package')
                                ->orderByDesc('created_at')
                                ->chunk(200, function ($leads) use ($handle): void {
                                    foreach ($leads as $lead) {
                                        fputcsv($handle, [
                                            $lead->id,
                                            $lead->created_at?->format('Y-m-d H:i:s'),
                                            $lead->brand_name ?? '-',
                                            $lead->package?->name_id ?? '-',
                                            strtoupper($lead->lang),
                                            $lead->status,
                                            $lead->ip_address ?? '-',
                                            str_replace(["\r", "\n"], ' ', $lead->message),
                                        ]);
                                    }
                                });

                            fclose($handle);
                        }, $filename, ['Content-Type' => 'text/csv; charset=UTF-8']);
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('whatsapp')
                    ->label('Hubungi WA')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->url(function (Lead $record): string {
                        $waNumber = preg_replace('/\D+/', '', (string) Setting::getValue('wa_number', '6285667667059'));
                        $reply = $record->brand_name
                            ? "Halo {$record->brand_name}, terima kasih sudah menghubungi BocahLabs!"
                            : 'Halo, terima kasih sudah menghubungi BocahLabs!';

                        return 'https://wa.me/' . $waNumber . '?text=' . rawurlencode($reply);
                    })
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}