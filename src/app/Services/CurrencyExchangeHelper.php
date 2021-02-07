<?php
declare(strict_types=1);

namespace App\Services;

class CurrencyExchangeHelper
{
    public function satoshiToUsd(int $satoshiAmount, float $btcPriceInUsd): float
    {
        $result = (float) ($satoshiAmount / 10 ** 8) * $btcPriceInUsd;

        return round($result, 2);
    }

    public function usdToSatoshi(float $usdAmount, float $btcPriceInUsd): int
    {
        return (int) ($usdAmount / $btcPriceInUsd * (10 ** 8));
    }
}
