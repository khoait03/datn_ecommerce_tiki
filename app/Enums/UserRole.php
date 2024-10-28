<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case Nam = 'Nam';
    case Nu = 'Nữ';


    public function getName(): string
    {
        return match ($this) {
            self::Nam => 'Nam',
            self::Nu => 'Nữ',
        };
    }

    public function getLabel(): string
    {
        return $this->name;
    }

}
