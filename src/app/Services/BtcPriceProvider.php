<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BtcPriceProvider
{
    public function getPriceInUsd(): float
    {
        $response = Http::get('https://api.pro.coinbase.com/products/BTC-USD/ticker');

        if (!$response->successful()) {
            $response->throw();
        }

        return $response->json('price');
    }
}
