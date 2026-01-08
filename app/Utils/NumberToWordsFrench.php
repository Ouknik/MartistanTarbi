<?php

namespace App\Utils;

class NumberToWordsFrench
{
    private function __construct()
    {
    }

    private const _zero = 'zéro'; //0
    private const _hundred = 'cent'; //100
    private const _thousand = 'mille'; //1000
    private const _million = 'million'; //1000000
    private const _billion = 'milliard'; //1000000000

    private const _numNames = [
        '',
        'un',
        'deux',
        'trois',
        'quatre',
        'cinq',
        'six',
        'sept',
        'huit',
        'neuf',
        'dix',
        'onze',
        'douze',
        'treize',
        'quatorze',
        'quinze',
        'seize',
        'dix-sept',
        'dix-huit',
        'dix-neuf'
    ];

    private const _tensNames = [
        '',
        'dix',
        'vingt',
        'trente',
        'quarante',
        'cinquante',
        'soixante',
        '',
        'quatre-vingt',
        ''
    ];

    private static function _convertLessThanOneThousand(int $number): string
    {
        $soFar = '';

        if ($number % 100 < 20) {
            $soFar = self::_numNames[$number % 100];
            $number = (int)($number / 100);
        } else {
            $tens = $number % 100;
            $soFar = '';
            if ($tens > 10) {
                $soFar .= '-' . self::_numNames[$tens % 10];
                $tens = (int)($tens / 10);
            }
            $soFar = self::_tensNames[$tens] . $soFar;
            $number = (int)($number / 100);
        }
        if ($number == 0) return $soFar;
        return self::_numNames[$number] . ' ' . self::_hundred . ($soFar !== '' ? ' ' . $soFar : '');
    }

    public static function convert(int $number): string
    {
        if ($number == 0) return self::_zero;

        $res = '';
        $billions = (int)($number / 1000000000);
        if ($billions != 0) {
            $res .= ($billions > 1 ? self::convert($billions) . ' ' . self::_billion . 's' : self::_billion);
            $number %= 1000000000;
        }
        $millions = (int)($number / 1000000);
        if ($millions != 0) {
            if ($res !== '') $res .= ' ';
            $res .= ($millions > 1 ? self::convert($millions) . ' ' . self::_million . 's' : self::_million);
            $number %= 1000000;
        }
        $thousands = (int)($number / 1000);
        if ($thousands != 0) {
            if ($res !== '') $res .= ' ';
            $res .= ($thousands > 1 ? self::convert($thousands) . ' ' . self::_thousand : self::_thousand);
            $number %= 1000;
        }
        if ($number != 0) {
            if ($res !== '') $res .= ' ';
            $res .= self::_convertLessThanOneThousand($number);
        }
        return $res;
    }
}
