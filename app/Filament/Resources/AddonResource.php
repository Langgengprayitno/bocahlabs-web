<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddonResource\Pages;
use App\Models\Addon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AddonResource extends Resource
{
    protected static ?string $model = Addon::class;

    protected static ?string $navigationIcon = 'heroicon-o-plus-circle';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Konfigurasi Add-on')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(100)
                        ->unique(ignoreRecord: true),
                    Forms\Components\TextInput::make('icon')
                        ->label('Nama Ikon Lucide')
                        ->required()
                        ->helperText('Contoh: pen-tool, map-pin, shield-check'),
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
                            Forms\Components\TextInput::make('name_id')
                                ->label('Nama Add-on (ID)')
                                ->required()
                                ->maxLength(150),
                            Forms\Components\TextInput::make('price_label_id')
                                ->label('Harga (ID)')
                                ->required()
                                ->maxLength(100),
                            Forms\Components\Textarea::make('desc_id')
                                ->label('Deskripsi (ID)')
                                ->rows(3)
                                ->required(),
                        ]),

                    Forms\Components\Tabs\Tab::make('English (EN)')
                        ->schema([
                            Forms\Components\TextInput::make('name_en')
                                ->label('Add-on Name (EN)')
                                ->required()
                                ->maxLength(150),
                            Forms\Components\TextInput::make('price_label_en')
                                ->label('Price Label (EN)')
                                ->required()
                                ->maxLength(100),
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
                Tables\Columns\TextColumn::make('sort_order')->label('#')->sortable(),
                Tables\Columns\TextColumn::make('name_id')->label('Nama (ID)')->searchable(),
                Tables\Columns\TextColumn::make('price_label_id')->label('Harga (ID)'),
                Tables\Columns\TextColumn::make('icon')->label('Ikon')->badge(),
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
            'index' => Pages\ListAddons::route('/'),
            'create' => Pages\CreateAddon::route('/create'),
            'edit' => Pages\EditAddon::route('/{record}/edit'),
        ];
    }
}