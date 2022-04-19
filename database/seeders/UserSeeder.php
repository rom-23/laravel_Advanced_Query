<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()

    {
        User::factory(10)
            ->create()
            ->each(function ($user) {
                $reservations = $user->reservations()->saveMany(Reservation::factory(random_int(1,3))->make());

                foreach($reservations as $reservation)
                {
                    $room_ids = [];
                    for($i=1; $i<= random_int(1,3); $i++)
                    {
                        $room_ids[] = random_int(1, 20);
                    }
                    $reservation->rooms()->attach($room_ids, ['status' => (bool) random_int(0,1)]);
                }
            });
    }

}
