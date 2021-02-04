<?php

namespace App\Http\Controllers;

use App\Enums\TradeStatusEnum;
use App\Http\Resources\TradeResource;
use App\Models\Trade;
use App\Models\User;
use App\Services\BtcPriceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    public function index()
    {
        return TradeResource::collection(Trade::all());
    }

    public function show(Trade $trade)
    {
        return TradeResource::make($trade);
    }

    public function store(Request $request, BtcPriceProvider $btcPriceProvider)
    {
        return DB::transaction(function () use ($request, $btcPriceProvider) {
            $validated = $request->validate([
                'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            ]);
            $buyer = User::firstOrFail();
            $seller = User::latest('id')->firstOrFail();
            $buyerWallet = $buyer->wallet()->lockForUpdate()->first();
            $sellerWallet = $seller->wallet()->lockForUpdate()->first();
            $usdAmount = (float) $validated['amount'];
            $rate = (float) $btcPriceProvider->getPriceInUsd();
            $satoshiAmount = (int) ($usdAmount / $rate * (10 ** 8));

            if ($buyerWallet->balance < $satoshiAmount) {
                throw new \Exception('Not enough satoshi in seller`s wallet.');
            }

            $sellerWallet->balance -= $satoshiAmount;
            $sellerWallet->save();
            $buyerWallet->balance += $satoshiAmount;
            $buyerWallet->save();

            $trade = new Trade();
            $trade->amount = $satoshiAmount;
            $trade->rate = $rate;
            $trade->status = TradeStatusEnum::PAID();
            $trade->payment_method_name = 'PayPal';
            $trade->buyer_id = $buyer->id;
            $trade->save();

            return TradeResource::make($trade);
        });
    }
}
