<?php

namespace App\Services;

class Helper
{
    public static function getTime($timestamp): string
    {
        $seconds = $timestamp % 60;
        $seconds = $seconds < 10 ? '0' . $seconds : $seconds;
        $minutes = floor($timestamp / 60) % 60;
        $minutes = $minutes < 10 ? '0' . $minutes : $minutes;
        $hours = floor($timestamp / (60 * 60));
        $result = '';
        if ($hours > 0) $result .= "$hours:";
        $result .= "$minutes:$seconds";
        return $result;
    }

    public static function cleanString(string $string)
    {
        $string = str_replace('🔔', '', $string);
        $string = str_replace('🔶', '', $string);
        $string = str_replace('💡', '', $string);
        return $string;
    }
}
