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
        $response = $this->httpClient->get(config('app.btc_price_provider_url'));

        if (!$response->successful()) {
            throw new BtcUsdRateRequestException();
        }

        return (float) $response->json('price');
    }
}
