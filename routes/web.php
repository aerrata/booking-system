<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/room', function () {
    return view('room.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/partials/user-count', [App\Http\Controllers\HomeController::class, 'partialUserCount'])->name('home.partialUserCount');
Route::get('/home/partials/room-count', [App\Http\Controllers\HomeController::class, 'partialRoomCount'])->name('home.partialRoomCount');
Route::get('/home/partials/booking-count', [App\Http\Controllers\HomeController::class, 'partialBookingCount'])->name('home.partialBookingCount');

Route::middleware(['auth'])->group(function () {
    Route::resource('room', App\Http\Controllers\RoomController::class);
    Route::resource('booking', App\Http\Controllers\BookingController::class);
    Route::resource('notification', App\Http\Controllers\NotificationController::class);
});

Route::get('/login-as/{username}', function ($username) {
    $user = \App\Models\User::where('email', $username . '@domain.com')->first();
    if ($user) {
        Auth::loginUsingId($user->id, true);
    } else {
        dd('Username not found!');
    }
    return redirect()->route('home');
});
