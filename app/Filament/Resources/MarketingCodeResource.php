<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarketingCodeResource\Pages;
use App\Models\MarketingCode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MarketingCodeResource extends Resource
{
    protected static ?string $model = MarketingCode::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationLabel = 'Kode Marketing';

    protected static ?string $navigationGroup = 'CRM & Konsultasi';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Detail Kode Tim Marketing')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('code')
                        ->label('Kode Unik')
                        ->required()
                        ->maxLength(50)
                        ->unique(ignoreRecord: true)
                        ->placeholder('Contoh: BOCAH-RINA')
                        ->helperText('Otomatis disimpan dalam huruf kapital.'),
                    Forms\Components\TextInput::make('marketer_name')
                        ->label('Nama Tim Marketing')
                        ->required()
                        ->maxLength(120)
                        ->placeholder('Contoh: Rina Wijaya'),
                    Forms\Components\TextInput::make('discount_label')
                        ->label('Info Potongan Harga Spesial')
                        ->maxLength(150)
                        ->placeholder('Contoh: Potongan Rp 150.000 / Diskon 10%')
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Kode Aktif')
                        ->default(true),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Unik')
                    ->badge()
                    ->color('primary')
                    ->copyable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('marketer_name')
                    ->label('Tim Marketing')
                    ->searchable(),
                Tables\Columns\TextColumn::make('discount_label')
                    ->label('Potongan Harga')
                    ->placeholder('—'),
                Tables\Columns\TextColumn::make('leads_count')
                    ->label('Total Klien')
                    ->counts('leads')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->actions([
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
            'index' => Pages\ListMarketingCodes::route('/'),
            'create' => Pages\CreateMarketingCode::route('/create'),
            'edit' => Pages\EditMarketingCode::route('/{record}/edit'),
        ];
    }
}