<?php

namespace App\Logic\QRCode;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class QRCodeMaker {

    static public function qrcode($content){
        
        $result = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data($content)
            ->encoding(new Encoding('UTF-8'))
            ->size(300)
            ->margin(10)
            ->logoPath(__DIR__.'/icon.png')
            ->logoResizeToWidth(50)
            ->logoPunchoutBackground(true)
            ->validateResult(false)
            ->build();

        // Generate a data URI to include image data inline (i.e. inside an <img> tag)
        return $result->getDataUri();
    }
}