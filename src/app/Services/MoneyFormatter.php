<?php
declare(strict_types=1);

namespace App\Services;

class MoneyFormatter
{
    public function format(float $amount): string
    {
        return number_format($amount, 2, '.', '');
    }
}
