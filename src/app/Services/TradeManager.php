<?php
declare(strict_types=1);

namespace App\Services;

use App\Enums\PaymentMethodEnum;
use App\Enums\TradeStatusEnum;
use App\Exceptions\InsufficientSellerFundsException;
use App\Models\Trade;
use App\Models\User;
use Illuminate\Database\DatabaseManager;

class TradeManager
{
    private DatabaseManager $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param User $seller
     * @param User $buyer
     * @param int $satoshiAmount
     * @param float $rate
     * @return Trade
     * @throws \Throwable
     */
    public function trade(User $seller, User $buyer, int $satoshiAmount, float $rate): Trade
    {
        return $this->db->connection()->transaction(function () use ($seller, $buyer, $satoshiAmount, $rate) {
            $buyerWallet = $buyer->wallet()->lockForUpdate()->first();
            $sellerWallet = $seller->wallet()->lockForUpdate()->first();

            if ($buyerWallet->balance < $satoshiAmount) {
                throw new InsufficientSellerFundsException();
            }

            $sellerWallet->balance -= $satoshiAmount;
            $sellerWallet->save();
            $buyerWallet->balance += $satoshiAmount;
            $buyerWallet->save();

            $trade = new Trade();
            $trade->amount = $satoshiAmount;
            $trade->rate = $rate;
            $trade->status = TradeStatusEnum::PAID();
            $trade->payment_method_name = PaymentMethodEnum::WEBMONEY();
            $trade->buyer_id = $buyer->id;
            $trade->seller_id = $seller->id;
            $trade->save();

            return $trade;
        });
    }
}
