<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Models\Tag;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTag extends CreateRecord
{
    protected static string $resource = TagResource::class;

    protected function beforeCreate()
    {
        $name = $this->data['name'];
        $userId = Auth::id();

        // Cek apakah tag dengan nama yang sama sudah ada dan dimiliki user lain
        $tagExists = Tag::where('name', $name)
            ->where('user_id', '!=', $userId)
            ->exists();

        if ($tagExists) {
            // Jika sudah ada, tampilkan notifikasi dan hentikan proses create
            Notification::make()
                ->title('Maaf nama tags ini sudah dipakai user lain, ayo beri nama tags mu seunik mungkin')
                ->danger()
                ->send();

            // Stop proses penyimpanan
            $this->halt();
        }
    }
}
