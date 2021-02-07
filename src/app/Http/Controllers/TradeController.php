<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PaymentMethodEnum;
use App\Enums\TradeStatusEnum;
use App\Http\Requests\StoreTradeRequest;
use App\Http\Resources\TradeResource;
use App\Models\Trade;
use App\Models\User;
use App\Services\BtcPriceProvider;
use App\Services\CurrencyExchangeHelper;
use App\Services\MoneyTransferManager;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TradeController extends Controller
{
    public function index()
    {
        return TradeResource::collection(Trade::all());
    }

    public function show(Trade $trade): TradeResource
    {
        return TradeResource::make($trade);
    }

    public function store(
        StoreTradeRequest $request,
        BtcPriceProvider $btcPriceProvider,
        CurrencyExchangeHelper $currencyExchangeHelper,
        MoneyTransferManager $moneyTransferManager
    ): TradeResource {
        $buyer = User::firstOrFail();
        $seller = User::latest('id')->firstOrFail();

        try {
            $rate = $btcPriceProvider->getPriceInUsd();
            $usdAmount = (float) $request->amount;
            $satoshiAmount = $currencyExchangeHelper->usdToSatoshi($usdAmount, $rate);
            $moneyTransferManager->transferSatoshi($seller, $buyer, $satoshiAmount);
        } catch (\Throwable $exception) {
            response()->json([
                'status' => 'failed',
                'error' => $exception->getMessage(),
            ]);
        }

        $trade = new Trade();
        $trade->amount = $satoshiAmount;
        $trade->rate = $rate;
        $trade->status = TradeStatusEnum::PAID();
        $trade->payment_method_name = PaymentMethodEnum::WEBMONEY();
        $trade->buyer_id = $buyer->id;
        $trade->seller_id = $seller->id;
        $trade->save();

        return TradeResource::make($trade);
    }
}
