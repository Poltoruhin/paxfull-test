<?php

namespace Database\Seeders;

use App\Models\Trade;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(3)
            ->has(Trade::factory()->count(3), 'purchases')
            ->has(Wallet::factory()->count(1))
            ->create();
    }
}
