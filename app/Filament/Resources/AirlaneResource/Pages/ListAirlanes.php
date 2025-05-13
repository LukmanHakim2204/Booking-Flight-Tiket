<?php

namespace App\Filament\Resources\AirlaneResource\Pages;

use App\Filament\Resources\AirlaneResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAirlanes extends ListRecords
{
    protected static string $resource = AirlaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
