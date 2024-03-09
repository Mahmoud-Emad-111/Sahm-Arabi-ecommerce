<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StorageFileTrait
{
    public function fileRemove($file){
        if (Storage::disk('StoreApp')->exists($file)) {
            Storage::disk('StoreApp')->delete($file);
        }
    }
}
