<?php

namespace App\Enums;

enum OfferingTypeEnum: string
{
    case PRODUCT = 'product';
    case SERVICE = 'service';

    public function label(): string
    {
        return match ($this) {
            self::PRODUCT => 'Produk',
            self::SERVICE => 'Jasa',
        };
    }
}
