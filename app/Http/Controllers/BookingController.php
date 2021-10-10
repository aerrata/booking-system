<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BookingStatus;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::where('enabled', 1)
            ->with('room', 'booking_status')
            ->when(auth()->user()->hasRole('user'), function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->get()
            ->transform(function ($booking) {
                return [
                    'title' => $booking->applicant,
                    'url' => route('booking.edit', $booking),
                    'start' => $booking->start_date,
                    'end' => $booking->end_date,
                    'color' => $booking->booking_status->color,
                ];
            });

        return view('booking.index', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.edit', [
            'booking' => new Booking,
            'booking_statuses' => BookingStatus::where('enabled', 1)->get(),
            'rooms' => Room::where('enabled', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'applicant' => ['required', 'max:255'],
            'purpose' => ['required', 'max:255'],
            'notes' => ['required', 'max:500'],
            'participant_total' => ['required', 'numeric'],
            'start_date' => ['required', 'date', 'after_or_equal:now'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'room_id' => ['required'],
        ]);

        Booking::create([
            'uuid' => Str::uuid(),
            'applicant' => $request->applicant,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'participant_total' => $request->participant_total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_id' => $request->room_id,
            'booking_status_id' => 1, // Dalam proses
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking, Request $request)
    {
        Gate::authorize('update', $booking);

        return view('booking.edit', [
            'booking' => $booking,
            'booking_statuses' => BookingStatus::where('enabled', 1)->get(),
            'approved' => $request->user()->can('approve_booking'),
            'rooms' => Room::where('enabled', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'applicant' => ['required', 'max:255'],
            'purpose' => ['required', 'max:255'],
            'notes' => ['required', 'max:500'],
            'participant_total' => ['required', 'numeric'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'room_id' => ['required'],
        ]);

        $booking->update([
            'applicant' => $request->applicant,
            'purpose' => $request->purpose,
            'notes' => $request->notes,
            'participant_total' => $request->participant_total,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_id' => $request->room_id,
            'booking_status_id' => $request->booking_status_id ?? 1,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('booking.index')->with('success', 'Booking updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
