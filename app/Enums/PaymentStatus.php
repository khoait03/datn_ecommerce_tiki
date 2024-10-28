<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PaymentStatus: string implements HasLabel, HasIcon, HasColor
{
    case Unpaid = 'Chưa thanh toán';
    case Paid = 'Đã thanh toán';

    public function getLabel(): string
    {
        return match ($this) {
            self::Unpaid => 'Chưa thanh toán',
            self::Paid => 'Đã thanh toán',
        };
    }


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Unpaid => 'danger',
            self::Paid => 'success',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Unpaid => 'heroicon-m-x-circle',
            self::Paid => 'heroicon-m-check-badge',
        };
    }
}
