<?php
declare(strict_types=1);

namespace App\Services;

class CurrencyExchangeHelper
{
    public function satoshiToUsd(int $satoshiAmount, float $btcPriceInUsd): float
    {
        $result = (float) (bcmul(
            (string) ($satoshiAmount / 10 ** 8),
            (string) $btcPriceInUsd,
            4)
        );

        return round($result, 2);
    }

    public function usdToSatoshi(float $usdAmount, float $btcPriceInUsd): int
    {
        return (int) (bcdiv(
            (string) $usdAmount,
            (string) $btcPriceInUsd,
            8
        ) * (10 ** 8));
    }
}
