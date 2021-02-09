<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\BtcUsdRateRequestException;
use Illuminate\Config\Repository;
use Illuminate\Http\Client\Factory;

class BtcPriceProvider
{
    private Factory $httpClient;

    private Repository $config;

    public function __construct(Factory $httpClient, Repository $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config;
    }

    /**
     * @throws BtcUsdRateRequestException
     */
    public function getPriceInUsd(): float
    {
        $response = $this->httpClient->get($this->config->get('app.btc_price_provider_url'));

        if (!$response->successful()) {
            throw new BtcUsdRateRequestException();
        }

        return (float) $response->json('price');
    }
}
