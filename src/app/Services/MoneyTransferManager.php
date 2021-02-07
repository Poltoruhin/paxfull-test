<?php
declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InsufficientSellerFundsException;
use App\Models\User;
use Illuminate\Database\DatabaseManager;

class MoneyTransferManager
{
    private DatabaseManager $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @throws \Throwable
     */
    public function transferSatoshi(User $seller, User $buyer, int $satoshiAmount): void
    {
        $this->db->connection()->transaction(function () use ($seller, $buyer, $satoshiAmount) {
            $buyerWallet = $buyer->wallet()->lockForUpdate()->first();
            $sellerWallet = $seller->wallet()->lockForUpdate()->first();

            if ($buyerWallet->balance < $satoshiAmount) {
                throw new InsufficientSellerFundsException();
            }

            $sellerWallet->balance -= $satoshiAmount;
            $sellerWallet->save();
            $buyerWallet->balance += $satoshiAmount;
            $buyerWallet->save();
        });
    }
}
