<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait SaveImagesTrait
{
    /**
     * Save images
     */
    // image array product
    public function saveImageArray($images, string $name)
    {
           $imagePaths = [];
           foreach ($images as $image) {
            $fullPath=$image->store($name , 'StoreApp');
            $imagePaths[] = asset(Storage::url($fullPath));
           }
            return $imagePaths;

    }


    // handle image full project
    public function saveImage($images, string $name)
    {

            $fullPath=$images->store($name , 'StoreApp');
            return $fullPath;

    }


}
