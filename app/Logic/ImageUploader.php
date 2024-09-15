<?php

namespace App\Logic;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

class ImageUploader {

    /**
    *
    *@param \Illuminate\Http\UploadedFile $file
    *@param string $image_directory
    *
    *@return array
    */
    static public function upload($file, $image_directory = "uploads"){
        
        $storage = env('IMAGE_STORAGE', "file");

        $ext = $file->getClientOriginalExtension();
        $thumbnail = ['height' => 500, 'width' => 500];
        $path_directory = storage_path("app/public/{$image_directory}/" . Carbon::now()->format('Ymd'));
        $resized_directory = storage_path("app/public/{$image_directory}/" . Carbon::now()->format('Ymd') . "/resized");
        $thumb_directory = storage_path("app/public/{$image_directory}/" . Carbon::now()->format('Ymd') . "/thumbnails");

        if (!File::exists($path_directory)){
            File::makeDirectory($path_directory, 0777, true);
        }

        if (!File::exists($resized_directory)){
            File::makeDirectory($resized_directory, 0777, true);
        }

        if (!File::exists($thumb_directory)){
            File::makeDirectory($thumb_directory, 0777, true);
        }

        $filename = Str::random(20) . date("mdYhs") . "." . $ext;
        
        $file->move($path_directory, $filename);

        if(in_array(Str::lower($ext), ['jpg','png','jpeg','gif','webp'])){
            Image::make("{$path_directory}/{$filename}")->save("{$resized_directory}/{$filename}",95);
            Image::make("{$path_directory}/{$filename}")->crop($thumbnail['width'], $thumbnail['height'])->save("{$thumb_directory}/{$filename}",95);
        }

        // Read the file and encode it to base64
        $imagePath = "{$path_directory}/{$filename}";
        $imageData = file_get_contents($imagePath);
        $base64Image = base64_encode($imageData);

        return [
            "path" => "storage/app/public/{$image_directory}/" . Carbon::now()->format('Ymd'),
            "directory" => URL::to("storage/app/public/{$image_directory}/" . Carbon::now()->format('Ymd')),
            "filename" => $filename,
            "esignature" => "data:image/png;base64,".$base64Image
        ];
    }
}