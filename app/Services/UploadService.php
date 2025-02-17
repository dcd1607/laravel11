<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
    }

    public static function upload(UploadedFile $file, string $folder, $disk = 'public'): string
    {
      $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

      $extension = $file->getClientOriginalExtension();

      $filenamem = $filename . '_' . time() . '.' . $extension;

      return $file->storeAs($folder, $filenamem, $disk);
    }

    public static function delete(string $path, $disk = 'public'): bool
    {
      if (Storage::disk($disk)->exists($path)) {
        return false;
      }

        return Storage::disk($disk)->delete($path);
    }

    public static function url(string $path, $disk = 'public'): string
    {
        return asset(Storage::url($path));
    }
}
