<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = Room::where('enabled', 1)
            ->with('room_category')
            ->when($request->name, function ($query, $name) {
                $query->where('name', 'like', '%' . $name . '%');
            })
            ->when($request->room_category_id, function ($query, $room_category_id) {
                $query->where('room_category_id', $room_category_id);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('room.index', [
            'rooms' => $rooms,
            'room_categories' => RoomCategory::where('enabled', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('create', Room::class);

        return view('room.edit', [
            'room' => new Room,
            'room_categories' => RoomCategory::where('enabled', 1)->get()
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
            'name' => ['required', 'max:255'],
            'capacity' => ['required', 'max:4'],
            'room_category_id' => ['required'],
        ], [
            'name.required' => 'The :attribute is required.',
            'name.max' => 'The :attribute may not be greater than :max characters.',
            'capacity.required' => 'The :attribute is required.',
            'capacity.max' => 'The :attribute may not be greater than :max characters.',
            'room_category_id.required' => 'The :attribute is required.',
        ]);

        Room::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'user_id' => auth()->id(),
            'room_category_id' => $request->room_category_id,
        ]);

        return redirect()->route('room.index')->with('success', 'Room created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return view('room.show', [
            'room' => $room->load('room_category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        Gate::authorize('update', $room);

        return view('room.edit', [
            'room' => $room,
            'room_categories' => RoomCategory::where('enabled', 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'capacity' => ['required', 'max:4'],
            'room_category_id' => ['required'],
        ], [
            'name.required' => 'The :attribute is required.',
            'name.max' => 'The :attribute may not be greater than :max characters.',
            'capacity.required' => 'The :attribute is required.',
            'capacity.max' => 'The :attribute may not be greater than :max characters.',
            'room_category_id.required' => 'The :attribute is required.',
        ]);

        $room->update([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'user_id' => auth()->id(),
            'room_category_id' => $request->room_category_id,
        ]);

        return redirect()->route('room.index')->with('success', 'Room updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        Gate::authorize('delete', $room);

        $room->delete();

        return redirect()->route('room.index')->with('success', 'Room deleted.');
    }
}
