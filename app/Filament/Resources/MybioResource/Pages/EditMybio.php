<?php

namespace App\Filament\Resources\MybioResource\Pages;

use App\Filament\Resources\MybioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyBio extends EditRecord
{
    protected static string $resource = MybioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
