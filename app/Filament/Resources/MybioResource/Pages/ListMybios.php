<?php

namespace App\Filament\Resources\MybioResource\Pages;

use App\Filament\Resources\MybioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Mybio;
use Illuminate\Support\Facades\Auth;

class ListMyBios extends ListRecords
{
    protected static string $resource = MybioResource::class;

    protected function getHeaderActions(): array
    {
        // Cek apakah ada data bio untuk user yang sedang login
        $hasMybio = Mybio::where('user_id', Auth::id())->exists();

        // Jika data bio tidak ada, tampilkan tombol Create
        return $hasMybio ? [] : [
            Actions\CreateAction::make(),
        ];
    }
}
