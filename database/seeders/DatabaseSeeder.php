<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use App\Models\Company;
use App\Models\Measure;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
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
        User::factory(5)->create();
        Category::factory(10)->create();
        Measure::factory(5)->create();
        Company::factory(1)->create();
        Product::factory(10)->create();
        Customer::factory(5)->create();
        Sale::factory(10)->create()->each(function ($sale) {
            $sale->details()->create([
                'sale_id' => $sale->id,
                'product_id' => Product::all()->random()->id,
                'quantity' => $sale->items,
                'price' => $sale->total / $sale->items
            ]);
        });
        Payment::factory(10)->create();
    }
}
