<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class RoomFactory extends Factory
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
            'created_at'=>$this->faker->dateTimeBetween('-10 days','-5 days'),
            'updated_at'=>$this->faker->dateTimeBetween('-3 days','-1 hour'),
//            'hotel_id'=>Hotel::pluck('id')->random(),
//            'room_type_id'=>RoomType::pluck('id')->random()
        'room_type_id'=>RoomType::factory()->create()

        ];
    }
}
