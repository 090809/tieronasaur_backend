<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;

class ImageUploader
{
    /**
     * @param UploadedFile $files
     * @return string
     */
    public function upload(UploadedFile $files): string
    {
        $currentDirPath = $this->getCurrentDirPath();

        $originalPath = $files->store('public/' . $currentDirPath);
        $path = str_replace('public/', '', $originalPath);

        return $path;
    }

    /**
     * @return string
     */
    public function getCurrentDirPath(): string
    {
        return 'photos/' . date('y') . '/' . date('m') . '/' . date('d');
    }
}
