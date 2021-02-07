<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Trade;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $seller = User::factory()->has(Wallet::factory()->count(1))->create();

        for ($i = 0; $i <= 5; $i++) {
            $buyer = User::factory()->has(Wallet::factory()->count(1))->create();

            Trade::factory()->create([
                'seller_id' => $seller,
                'buyer_id' => $buyer,
            ]);
        }
    }
}
