<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $countries=Country::factory(10)
            ->create()
            ->each(function ($country) {
                $country->cities()->saveMany(City::factory(random_int(1,10))->make());
            });
        foreach ($countries as $country)
        {
            foreach ($country->cities as $city)
            {
                $hotels = $city->hotels()->saveMany(Hotel::factory(random_int(1,4))->make());

                foreach ($hotels as $hotel)
                {
                    $hotel->rooms()->saveMany(Room::factory(random_int(3,10))->make());
                }
            }
        }
    }
}
