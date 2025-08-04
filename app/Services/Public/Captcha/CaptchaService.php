<?php

namespace App\Services\Public\Captcha;

use Illuminate\Support\Facades\Session;

class CaptchaService
{
    public function generate(int $width = 160, int $height = 50): string
    {
        $code = '';
        $chars = 'ABCDEFGHJKLMNPRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $codeLength = 6;

        for ($i = 0; $i < $codeLength; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }

        Session::put('captcha', $code);

        $image = imagecreate($width, $height);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgColor);
        $textColor = imagecolorallocate($image, 0, 0, 0);

        $lineColors = [];
        for ($i = 0; $i < 5; $i++) {
            $lineColors[] = imagecolorallocate($image, 120 + $i * 10, 120 + $i * 10, 120 + $i * 10);
        }
        $dotColors = [];
        for ($i = 0; $i < 3; $i++) {
            $gray = 180 + $i * 20;
            $dotColors[] = imagecolorallocate($image, $gray, $gray, $gray);
        }

        for ($i = 0; $i < 10; $i++) {
            $color = $lineColors[array_rand($lineColors)];
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $color);
        }

        for ($i = 0; $i < 1000; $i++) {
            $color = $dotColors[array_rand($dotColors)];
            imagesetpixel($image, rand(0, $width - 1), rand(0, $height - 1), $color);
        }

        $x = 15;
        $fontSize = 5;
        for ($i = 0; $i < strlen($code); $i++) {
            $y = rand(10, 30);
            imagestring($image, $fontSize, $x, $y, $code[$i], $textColor);
            $x += rand(10, 30);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        return $imageData;
    }
}
