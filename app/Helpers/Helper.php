<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function convertPersianToEnglishNumbers($input): array|string
    {
        $persianNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        return str_replace($persianNumbers, $englishNumbers, $input);
    }

    public static function deleteFile(string $url): bool
    {
        if (Storage::disk('public')->exists($url)) {
            return Storage::disk('public')->delete($url);
        }
        return false;
    }
}
