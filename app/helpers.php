<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function storeImage(string $path, UploadedFile $image): string
{
    $path = Storage::putFile($path, $image);

    return substr($path, 14);
}

function deleteImage(string $path, string $fileName): void
{
    Storage::delete("public/images/{$fileName}");
}
