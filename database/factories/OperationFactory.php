<?php

namespace Database\Factories;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->name,
            'amount' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 0),
            'status' => $this->faker->randomElement(['Zrealizowany', 'Zlecony','Wysłany', 'Oczekujacy']),
        ];
    }
}
