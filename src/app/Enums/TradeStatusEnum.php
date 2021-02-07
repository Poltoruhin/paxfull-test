<?php
declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self NOT_PAID()
 * @method static self PAID()
 */
final class TradeStatusEnum extends Enum
{
    private const NOT_PAID = 'NOT_PAID';
    private const PAID = 'PAID';

    protected static function values(): array
    {
        return [
            self::NOT_PAID => 'Not Paid',
            self::PAID => 'Paid',
        ];
    }
}
