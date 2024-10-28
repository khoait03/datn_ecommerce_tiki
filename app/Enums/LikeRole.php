<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum LikeRole: string implements HasLabel
{
    case Like = 'Thích';
    case Dislike = 'Không thích';

    public function getName(): string
    {
        return match ($this) {
            self::Like => 'Thích',
            self::Dislike => 'Không thích',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::Like => 'Thích',
            self::Dislike => 'Không thích',
        };
    }
}
