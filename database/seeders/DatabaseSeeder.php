<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
//User::factory(10)->create();
        $this->call(UserSeeder::class);


//     Country::factory(10)->create();
//        City::factory(10)->create();
//        Hotel::factory(10)->create();
//        RoomType::factory(10)->create();
//        Room::factory(10)->create();
//        Reservation::factory(10)->create();

    }
}
