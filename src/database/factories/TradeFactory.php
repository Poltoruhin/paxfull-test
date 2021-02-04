<?php

namespace Database\Factories;

use App\Enums\TradeStatusEnum;
use App\Models\Trade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Enum\Faker\FakerEnumProvider;

class TradeFactory extends Factory
{
    protected $model = Trade::class;

    public function definition(): array
    {
        $this->faker->addProvider(new FakerEnumProvider($this->faker));

        return [
            'amount' => $this->faker->numberBetween(300000, 310000) * 100,
            'rate' => $this->faker->numberBetween(30000, 31000) * 100,
            'payment_method_name' => 'PayPal',
            'created_at' => $this->faker->time(),
            'updated_at' => $this->faker->time(),
            'status' => $this->faker->randomEnum(TradeStatusEnum::class),
        ];
    }
}
