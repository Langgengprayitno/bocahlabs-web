<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pengaturan Situs')
                ->schema([
                    Forms\Components\TextInput::make('key')
                        ->label('Kunci (Key)')
                        ->required()
                        ->maxLength(100)
                        ->unique(ignoreRecord: true)
                        ->disabledOn('edit'),
                    Forms\Components\Textarea::make('value')
                        ->label('Nilai (Value)')
                        ->rows(3)
                        ->nullable(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('key')
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Kunci')
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai')
                    ->limit(70)
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}