<?php
declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self PAYPAL()
 * @method static self WEBMONEY()
 */
final class PaymentMethodEnum extends Enum
{
}
