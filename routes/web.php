<?php

use App\Models\Reservation;
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
//    $results = Reservation::where(static function ($q) use ($check_in, $check_out) {
//        $q->where('check_in', '>', $check_in);
//        $q->where('check_out', '>=', $check_out);
//    })->orWhere(static function($q) use ($check_in, $check_out){
//        $q->where('check_in', '<=', $check_in);
//        $q->where('check_out', '<', $check_out);
//    })->get();
//dump($results);
        $results = DB::table('rooms')->whereNotExists(static function ($query) use ($check_in, $check_out) {
            $query->select('reservations.id')->from('reservations')->where(function($q) use ($check_in, $check_out){
               $q->where('check_out','>',$check_in);
                $q->where('check_in','>',$check_out);
            })->limit(1);
        })->paginate(10);
    dump($results);
    return view('welcome');
});
