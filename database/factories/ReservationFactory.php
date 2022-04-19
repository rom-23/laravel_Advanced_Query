<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'check_in' => $this->faker->dateTimeBetween('+2 days', '+5 days'),
            'check_out' => $this->faker->dateTimeBetween('+6 days', '+10 days'),
            'price' => $this->faker->numberBetween(100, 500),
//            'user_id'=>User::pluck('id')->random(),

        ];
    }
}
