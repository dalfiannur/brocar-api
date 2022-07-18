<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class PhoneNumberHelper
{
    public static function format(String $number, $locale = 'id')
    {
        if (Str::startsWith($number, '0')) {
            $number = Str::substr($number, 1);
        }

        if ($locale == 'id') {
            return '+62' . $number;
        }

        return $number;
    }
}
