<?php

namespace Database\Factories;

use App\Models\SaleDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SaleDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sale = \App\Models\Sale::doesnthave('details')->get()->first();

        return  [
            'sale_id' => $sale[0]->id,
            'product_id' => \App\Models\Product::all()->random(),
            'quantity' => $sale[0]->items,
            'price' => $sale[0]->total / $sale[0]->items,
        ];
    }
}
