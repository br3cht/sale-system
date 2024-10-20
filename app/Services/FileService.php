<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public function getTemporaryUrl(string $path, int $expiration): string
    {
        $pathCached = null;
        if(empty($path) && !Storage::has($path)){
            return '';
        }

        $pathCached = Cache::get($path);

        if(empty($pathCached)){
            $pathCached = Storage::temporaryUrl($path, $expiration);
            Cache::get($path, $pathCached);

            return $pathCached;
        }

        return $pathCached;
    }

    public function storeFile(
        string $folder,
        UploadedFile|File $file
    ):string
    {
        return Storage::putFile($folder, $file);
    }
}
