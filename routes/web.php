<?php

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    $check_in = '2020-06-20';
    $check_out = '2020-06-28';
    $city_id = 5;

//    $results = Reservation::where(static function ($q) use ($check_in, $check_out) {
//        $q->where('check_in', '>', $check_in);
//        $q->where('check_out', '>=', $check_out);
//    })->orWhere(static function($q) use ($check_in, $check_out){
//        $q->where('check_in', '<=', $check_in);
//        $q->where('check_out', '<', $check_out);
//    })->get();

    $results = DB::table('rooms')
        ->join('room_types','rooms.room_type_id','=','room_type_id')
        ->whereNotExists(static function ($query) use ($check_in, $check_out) {
            $query
                ->select('reservations.id')
                ->from('reservations')
                ->join('reservation_room', 'reservations.id', '=', 'reservation_room.reservation_id')
                ->whereColumn('rooms.id','reservation_room.room_id')
                ->where(function ($q) use ($check_in, $check_out) {
                    $q->where('check_out', '>', $check_in);
                    $q->where('check_in', '>', $check_out);
                })
                ->limit(1);
        })->whereExists(function($q) use($city_id){
            $q->select('hotels.id')
                ->from('hotels')
                ->whereColumn('rooms.hotel_id','hotels.id')
                ->whereExists(function($q) use($city_id){
                    $q->select('cities.id')
                        ->from('cities')
                        ->whereColumn('cities.id','hotels.city_id')
                        ->where('id',$city_id)
                        ->limit(1);
                })->limit(1);
        })
        ->paginate(10);

//    $results = Room::with('type')
//        ->whereDoesntHave('reservations', function ($q) use ($check_in, $check_out) {
//            $q->where('check_out', '>', $check_in);
//            $q->where('check_in', '<', $check_out);
//        })->get();



    dump($results);
    return view('welcome');
});
