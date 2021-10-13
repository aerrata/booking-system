<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count = Cache::remember('user_count', Carbon::parse('10 minutes'), function () {
            return User::count();
        });

        $room_count = Cache::remember('room_count', Carbon::parse('10 minutes'), function () {
            return Room::where('enabled', 1)->count();
        });
        
        $booking_count = Cache::remember('booking_count', Carbon::parse('10 minutes'), function () {
            return Booking::where([['enabled', 1], ['booking_status_id', 2]])->count();
        });

        return view('home', [
            'count' => [
                'user' => $user_count,
                'room' => $room_count,
                'booking' => $booking_count,
            ]
        ]);
    }
}
