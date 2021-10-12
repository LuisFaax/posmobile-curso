<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'sale_id' => Sale::all()->random()->id,
            'amount' => 0
        ];
    }


    public function configure()
    {
        return $this->afterMaking(function (Payment $pay) {
            $pays = $pay->sale->pays->sum('amount'); // sumatoria de los pagos
            $pending = $pay->sale->total - $pays; // adeudo actual
            $pay->amount = $this->faker->numberBetween(1, $pending); // monto del pago calculado
            $pay->save();
        });
    }
}
