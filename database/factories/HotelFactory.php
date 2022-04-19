<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> ucfirst(rtrim($this->faker->text(10), '.')),
            'description'=>$this->faker->sentence(),
            'created_at'=>$this->faker->dateTimeBetween('-20 days','-10 days'),
            'updated_at'=>$this->faker->dateTimeBetween('-5 days','-1 days'),
//            'city_id'=>City::pluck('id')->random()

        ];
    }
}
