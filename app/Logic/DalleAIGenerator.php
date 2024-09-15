<?php

namespace App\Logic;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DalleAIGenerator {

    /**
    *
    *@param \Illuminate\Http\UploadedFile $file
    *@param string $image_directory
    *
    *@return array
    */
    static public function generate($prompt){
        
        $apiKey = env('OPENAI_API_KEY');
        $apiUrl = env('OPENAI_API_URL');

        try {
            $response = Http::
                withOptions(
                    ['verify' => false,]
                )->withHeaders([
                    'Authorization' => "Bearer $apiKey",
                    'Content-Type' => 'application/json']
                )->post($apiUrl, [
                    'prompt' => $prompt,
                    'n' => 1,
                    'size' => '512x512'
            ]);

            if ($response->successful()) {

                $imageUrl = $response->json()['data'][0]['url'];
                $imageResponse = Http::withOptions(['verify' => false])->get($imageUrl);

                if ($imageResponse->successful()) {
                    $base64Image = base64_encode($imageResponse->body());
                    return "data:image/png;base64,".$base64Image;
                    // return response()->json(['base64_image' => $base64Image]);
                } else {
                    echo "Failed to fetch image from URL:".$imageResponse->body();
                    // Log::error('Failed to fetch image from URL: ' . $imageResponse->body());
                    return response()->json(['error' => 'Failed to fetch image'], 500);
                }

            } else {
                return response()->json(['error' => 'Failed to generate image'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred: ' . $e->getMessage());
            return response()->json(['error' => $e], 500);
        }

        return '';
    }
}