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
        return view('home.index', [
            'userCountPartialCache' => Cache::get('partial.user_count'),
            'roomCountPartialCache' => Cache::get('partial.room_count'),
            'bookingCountPartialCache' => Cache::get('partial.booking_count'),
        ]);
    }
    
    public function partialUserCount()
    {
        return Cache::remember('partials.user_count', Carbon::parse('10 minutes'), function () {
            return view('home._user_count', [
                'user_count' => User::count()
            ])->render();
        });
    }

    public function partialRoomCount()
    {
        return Cache::remember('partials.room_count', Carbon::parse('10 minutes'), function () {
            return view('home._room_count', [
                'room_count' => Room::where('enabled', 1)->count()
            ])->render();
        });
    }

    public function partialBookingCount()
    {
        return Cache::remember('partials.booking_count', Carbon::parse('10 minutes'), function () {
            return view('home._booking_count', [
                'booking_count' => Booking::where([['enabled', 1], ['booking_status_id', 2]])->count()
            ])->render();
        });
    }
}
