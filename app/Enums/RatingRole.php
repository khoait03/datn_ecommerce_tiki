<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum RatingRole: string implements HasLabel
{
    case oneStar = '1';
    case twoStar = '2';
    case threeStar = '3';
    case fourStar = '4';
    case fiveStar = '5';

    public function getName(): string
    {
        return match ($this) {
            self::oneStar => '1 sao',
            self::twoStar => '2 sao',
            self::threeStar => '3 sao',
            self::fourStar => '4 sao',
            self::fiveStar => '5 sao',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::oneStar => '⭐',
            self::twoStar => '⭐⭐',
            self::threeStar => '⭐⭐⭐',
            self::fourStar => '⭐⭐⭐⭐',
            self::fiveStar => '⭐⭐⭐⭐⭐',
        };
    }
}
