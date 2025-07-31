<?php

namespace App\Http\Controllers\Public\Auth\Captcha;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $code = '';
        $chars = 'ABCDEFGHJKLMNPRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
        $codeLength = 6;

        for ($i = 0; $i < $codeLength; $i++) {
            $code .= $chars[rand(0, strlen($chars) - 1)];
        }

        Session::put('captcha', $code);

        $width = 160;
        $height = 50;
        $image = imagecreate($width, $height);

        // Фон
        $bgColor = imagecolorallocate($image, 255, 255, 255);

        // Цвет текста (чёрный)
        $textColor = imagecolorallocate($image, 0, 0, 0);

        // Подготовим несколько цветов для шума заранее
        $lineColors = [];
        for ($i = 0; $i < 5; $i++) {
            $lineColors[] = imagecolorallocate($image, 120 + $i * 10, 120 + $i * 10, 120 + $i * 10);
        }
        $dotColors = [];
        for ($i = 0; $i < 3; $i++) {
            $gray = 180 + $i * 20;
            $dotColors[] = imagecolorallocate($image, $gray, $gray, $gray);
        }

        // Заполним фон белым
        imagefill($image, 0, 0, $bgColor);

        // Рисуем шум - линии, используя подготовленные цвета
        for ($i = 0; $i < 10; $i++) {
            $color = $lineColors[array_rand($lineColors)];
            imageline(
                $image,
                rand(0, $width),
                rand(0, $height),
                rand(0, $width),
                rand(0, $height),
                $color
            );
        }

        // Рисуем шум - точки, используя подготовленные цвета
        for ($i = 0; $i < 1000; $i++) {
            $color = $dotColors[array_rand($dotColors)];
            imagesetpixel($image, rand(0, $width - 1), rand(0, $height - 1), $color);
        }

        // Рисуем текст поверх шума
        $fontSize = 5;
        $x = 15;
        for ($i = 0; $i < $codeLength; $i++) {
            $y = rand(10, 30);
            imagestring($image, $fontSize, $x, $y, $code[$i], $textColor);
            $x += rand(10, 30);
        }

        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();
        imagedestroy($image);

        return response($imageData)->header('Content-Type', 'image/png');
    }
}
