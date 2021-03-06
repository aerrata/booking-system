@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">Rooms</div>

    <div class="card-body">
        <div>
            <button class="btn btn-primary btn-sm mb-3" type="button" data-toggle="collapse" data-target="#filter">
                <i class="ti ti-filter mr-1"></i>
                Filter
            </button>
            <div class="collapse mb-3" id="filter">
                <form action="{{ route('room.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ request()->input('name') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="room_category_id" class="col-form-label">Room Category</label>
                            <select class="custom-select" id="room_category_id" name="room_category_id">
                                <option value="">Choose..</option>
                                @foreach ($room_categories as $room_category)
                                <option value="{{ $room_category->id }}" {{ $room_category->id == request()->input('room_category_id') ? 'selected' : '' }}>{{ $room_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="ti ti-search mr-1"></i>
                            Search
                        </button>
                        <a href="{{ route('room.index') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-x mr-1"></i>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

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
                        <form action="{{ route('room.destroy', $room) }}" method="POST" id="form-room-destroy-{{ $room->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a class="btn btn-sm btn-link" href="{{ route('room.show', $room) }}">View</a>
                        @can ('edit_room')
                            <a class="btn btn-sm btn-link" href="{{ route('room.edit', $room) }}">Edit</a>
                        @endcan
                        @can ('delete_room')
                            <button type="submit" class="btn btn-sm btn-link" form="form-room-destroy-{{ $room->id }}" onclick="return confirm('Are you sure?')">Delete</button>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $rooms->links() }}
    </div>

    <div class="card-footer d-flex justify-content-end">
        @can ('create_room')
        <a href="{{ route('room.create') }}" class="btn btn-primary btn-sm">
            Create
        </a>
        @endcan
    </div>
</div>
@endsection
