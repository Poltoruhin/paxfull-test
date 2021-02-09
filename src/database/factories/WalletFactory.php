<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition(): array
    {
        return [
            'balance' => $this->faker->numberBetween(10**9, 10**10),
            'address' => $this->faker->uuid
        ];
    }
}
