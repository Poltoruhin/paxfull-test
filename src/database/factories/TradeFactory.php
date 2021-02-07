<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Enums\PaymentMethodEnum;
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
            'amount' => $this->faker->numberBetween(350000, 400000) * 100,
            'rate' => $this->faker->numberBetween(35000, 40000),
            'payment_method_name' => $this->faker->randomEnum(PaymentMethodEnum::class),
            'created_at' => $this->faker->time(),
            'updated_at' => $this->faker->time(),
            'status' => $this->faker->randomEnum(TradeStatusEnum::class),
        ];
    }
}
