<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Konten Website';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Urutan & Status')
                ->columns(2)
                ->schema([
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
                            Forms\Components\TextInput::make('question_id')
                                ->label('Pertanyaan (ID)')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Textarea::make('answer_id')
                                ->label('Jawaban (ID)')
                                ->rows(4)
                                ->required(),
                        ]),

                    Forms\Components\Tabs\Tab::make('English (EN)')
                        ->schema([
                            Forms\Components\TextInput::make('question_en')
                                ->label('Question (EN)')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Textarea::make('answer_en')
                                ->label('Answer (EN)')
                                ->rows(4)
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
                Tables\Columns\TextColumn::make('question_id')
                    ->label('Pertanyaan (ID)')
                    ->limit(70)
                    ->searchable(),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}