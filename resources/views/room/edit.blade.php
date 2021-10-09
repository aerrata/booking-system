@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $room->id ? "Edit Room - $room->name" : 'Create Room' }}</div>

    <div class="card-body">
        <form id="room-edit" action="{{ $room->id ? route('room.update', $room) : route('room.store') }}" method="post">
            @csrf
            @method($room->id ? 'put' : 'post')
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $room->name) }}">
              </div>
            </div>

            <div class="form-group row">
              <label for="capacity" class="col-sm-2 col-form-label">Capacity</label>
              <div class="col-sm-6">
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}">
              </div>
            </div>

            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Room Category</label>
                <div class="col-sm-8">
                    <select class="custom-select" id="room_category_id" name="room_category_id">
                        <option value="">Choose..</option>
                        @foreach ($room_categories as $room_category)
                        <option value="{{ $room_category->id }}"
                            {{ $room_category->id == old('room_category_id', $room->room_category_id) ? 'selected' : '' }}>
                            {{ $room_category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

          <div class="d-flex justify-content-end">
              <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
              <button type="submit" class="btn btn-primary" form="room-edit">Submit</button>
          </div>
        </form>
    </div>
</div>
@endsection
