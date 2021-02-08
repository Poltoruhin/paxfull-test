<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\BtcUsdRateRequestException;
use Illuminate\Http\Client\Factory;

class BtcPriceProvider
{
    private Factory $httpClient;

    public function __construct(Factory $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws BtcUsdRateRequestException
     */
    public function getPriceInUsd(): float
    {
        $response = $this->httpClient->get('https://api.pro.coinbase.com/products/BTC-USD/ticker');

        if (!$response->successful()) {
            throw new BtcUsdRateRequestException();
        }

        return (float) $response->json('price');
    }
}
