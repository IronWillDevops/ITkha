<?php

namespace App\Support;

class ByteFormatter
{
    public static function format(int $bytes, int $decimals = 2): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $factor = (int) floor(log($bytes, 1024));

        return sprintf("%.{$decimals}f", $bytes / (1024 ** $factor))
            . ' ' . $units[$factor];
    }
}
