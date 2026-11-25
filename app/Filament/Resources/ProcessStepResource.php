<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcessStepResource\Pages;
use App\Models\ProcessStep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProcessStepResource extends Resource
{
    protected static ?string $model = ProcessStep::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pengaturan Langkah')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('number')
                        ->label('Nomor (mis. 01)')
                        ->required()
                        ->maxLength(10),
                    Forms\Components\TextInput::make('icon')
                        ->label('Nama Ikon Lucide')
                        ->required()
                        ->helperText('Contoh: messages-square, layout-template, code-2, rocket'),
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(1)
                        ->required(),
                    Forms\Components\Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ]),

            Forms\Components\Tabs::make('Konten Dwibahasa')
                ->columnSpanFull()
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Bahasa Indonesia (ID)')
                        ->schema([
                            Forms\Components\TextInput::make('title_id')
                                ->label('Judul (ID)')
                                ->required()
                                ->maxLength(150),
                            Forms\Components\Textarea::make('desc_id')
                                ->label('Deskripsi (ID)')
                                ->rows(3)
                                ->required(),
                        ]),

                    Forms\Components\Tabs\Tab::make('English (EN)')
                        ->schema([
                            Forms\Components\TextInput::make('title_en')
                                ->label('Title (EN)')
                                ->required()
                                ->maxLength(150),
                            Forms\Components\Textarea::make('desc_en')
                                ->label('Description (EN)')
                                ->rows(3)
                                ->required(),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('number')->label('No')->badge(),
                Tables\Columns\TextColumn::make('title_id')->label('Judul (ID)')->searchable(),
                Tables\Columns\TextColumn::make('icon')->label('Ikon'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
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
            'index' => Pages\ListProcessSteps::route('/'),
            'create' => Pages\CreateProcessStep::route('/create'),
            'edit' => Pages\EditProcessStep::route('/{record}/edit'),
        ];
    }
}