<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile)
    {
        $image = new Image;

        if (is_array($imageFile)) {
            $file = $imageFile['image']; // 配列なので[‘key’] で取得
        } else {
            $file = $imageFile;
        }
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . rand();
        $extension = $file->extension();
        $fileNameToStore = $fileName. '.' . $extension;
        $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
        // バケットへアップロード
        Storage::disk('s3')->put('/'.$fileNameToStore, (string)$resizedImage, 'public');
        // アップロードした画像のフルパスを取得
        $path = Storage::disk('s3')->url('/'. $fileNameToStore);
        // dd($path);

        return $path;
    }
}
