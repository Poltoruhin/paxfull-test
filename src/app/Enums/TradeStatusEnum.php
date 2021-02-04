<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self NOT_PAID()
 * @method static self PAID()
 */
final class TradeStatusEnum extends Enum {
    protected static function values(): array
    {
        return [
            'NOT_PAID' => 'Not Paid',
            'PAID' => 'Paid',
        ];
    }
}
