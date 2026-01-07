<?php

namespace App\Helpers;
class KodeUnitHelper
{
    public static function generateKodeUnit(string $namaUnit, ?string $gender = null): string
    {
        return match ($namaUnit) {
            'tahsin' => $gender ? ($gender === 'ikhwan' ? 'TI' : 'TA') : 'ZZ',
            'rq' => 'RQ',
            'tla' => 'TL',
            'rtq-putra' => 'RA',
            'rtq-putri' => 'RI',
            default => 'ZZ',
        };
    }
}