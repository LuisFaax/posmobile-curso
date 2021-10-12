<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Measure;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cost = $this->faker->randomFloat(2, 0, 1000); // precio de compra
        $price1 = $cost * 1.30; // precio de compra + 30% de ganancia
        $price2 = $price1 - ($price1 * 0.05); // precio de mayoreo

        $stock = $this->faker->numberBetween(0, 500);
        return [
            'category_id' => Category::all()->random()->id,
            'measure_id' => Measure::all()->random()->id,
            'code' => $this->faker->unique()->ean13(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'cost' => $cost,
            'price1' => $price1,
            'price2' => $price2,
            'stock' => $stock,
            'minstock' => $this->faker->randomElement([5, 10, 15, 20, 25])
        ];
    }
}
