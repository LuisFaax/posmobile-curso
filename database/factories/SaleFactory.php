<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $total = $this->faker->randomFloat(2, 0, 10000);
        $discountRand = $this->faker->randomElement([0, 2, 8, 10]);
        $dto = intval(($total * $discountRand) / 100);

        return [
            'user_id' => User::all()->random()->id,
            'customer_id' => Customer::all()->random()->id,
            'items' => $this->faker->numberBetween(1, 10),
            'total' => $total,
            'discount' => $dto,
            'status' => $this->faker->randomElement(['Paid', 'Pending', 'Cancelled']),
            'mode' => $this->faker->randomElement(['Web', 'App']),
            'sync' => $this->faker->dateTimeThisYear()

        ];
    }
}
