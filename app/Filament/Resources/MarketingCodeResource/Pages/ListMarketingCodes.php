<?php

namespace App\Filament\Resources\MarketingCodeResource\Pages;

use App\Filament\Resources\MarketingCodeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMarketingCodes extends ListRecords
{
    protected static string $resource = MarketingCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
