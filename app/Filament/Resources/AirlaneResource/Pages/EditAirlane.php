<?php

namespace App\Filament\Resources\AirlaneResource\Pages;

use App\Filament\Resources\AirlaneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAirlane extends EditRecord
{
    protected static string $resource = AirlaneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
