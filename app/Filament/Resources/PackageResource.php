<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Models\Package;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Utama Paket')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(100)
                        ->unique(ignoreRecord: true),
                    Forms\Components\Select::make('tier')
                        ->required()
                        ->options([
                            'beginner' => 'Beginner',
                            'professional' => 'Professional',
                        ]),
                    Forms\Components\TextInput::make('price_label')
                        ->label('Label Harga')
                        ->required()
                        ->maxLength(100),
                    Forms\Components\TextInput::make('price_min')
                        ->label('Harga Minimum (Angka)')
                        ->numeric()
                        ->required()
                        ->default(0),
                    Forms\Components\TextInput::make('image_path')
                        ->label('Path Gambar')
                        ->required()
                        ->helperText('Contoh: images/packages/compro-mini.webp')
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(1)
                        ->required(),
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Toggle::make('is_popular')
                                ->label('Paket Populer'),
                            Forms\Components\Toggle::make('is_active')
                                ->label('Aktif')
                                ->default(true),
                        ]),
                ]),

            Forms\Components\Tabs::make('Konten Dwibahasa')
                ->columnSpanFull()
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Bahasa Indonesia (ID)')
                        ->schema([
                            Forms\Components\TextInput::make('name_id')
                                ->label('Nama Paket (ID)')
                                ->required()
                                ->maxLength(150),
                            Forms\Components\TextInput::make('tier_label_id')
                                ->label('Label Kelas (ID)')
                                ->required()
                                ->maxLength(80),
                            Forms\Components\Textarea::make('tagline_id')
                                ->label('Tagline (ID)')
                                ->rows(2)
                                ->required(),
                            Forms\Components\Repeater::make('features_id')
                                ->label('Daftar Fitur (ID)')
                                ->simple(
                                    Forms\Components\TextInput::make('fitur')
                                        ->required()
                                )
                                ->addActionLabel('Tambah Fitur (ID)')
                                ->defaultItems(1),
                        ]),

                    Forms\Components\Tabs\Tab::make('English (EN)')
                        ->schema([
                            Forms\Components\TextInput::make('name_en')
                                ->label('Package Name (EN)')
                                ->required()
                                ->maxLength(150),
                            Forms\Components\TextInput::make('tier_label_en')
                                ->label('Tier Label (EN)')
                                ->required()
                                ->maxLength(80),
                            Forms\Components\Textarea::make('tagline_en')
                                ->label('Tagline (EN)')
                                ->rows(2)
                                ->required(),
                            Forms\Components\Repeater::make('features_en')
                                ->label('Feature List (EN)')
                                ->simple(
                                    Forms\Components\TextInput::make('feature')
                                        ->required()
                                )
                                ->addActionLabel('Add Feature (EN)')
                                ->defaultItems(1),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('#')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name_id')
                    ->label('Nama Paket (ID)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tier')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'professional' ? 'info' : 'primary'),
                Tables\Columns\TextColumn::make('price_label')
                    ->label('Harga'),
                Tables\Columns\IconColumn::make('is_popular')
                    ->label('Populer')
                    ->boolean(),
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
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}