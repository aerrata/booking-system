@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">Rooms</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Capacity</th>
                    <th>Room Category</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <th>
                        {{ $loop->iteration + $rooms->firstItem() - 1 }}
                    </th>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->capacity }}</td>
                    <td>{{ $room->room_category->name }}</td>
                    <td>
                        <form id="form-room-destroy" action="{{ route('room.destroy', $room) }}" method="post">
                            @csrf
                            @method('delete')
                        </form>
                        <a class="btn btn-sm btn-link" href="{{ route('room.edit', $room) }}">Edit</a>
                        <button type="submit" class="btn btn-sm btn-link" form="form-room-destroy" onclick="return confirm('Are you sure?')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rooms->links() }}

        <a href="{{ route('room.create') }}" class="btn btn-primary">New</a>
    </div>
</div>
@endsection
