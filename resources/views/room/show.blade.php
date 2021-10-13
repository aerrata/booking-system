@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $room->name }}</div>

    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-md-right">Name</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $room->name }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label for="capacity" class="col-sm-2 col-form-label text-md-right">Capacity</label>
            <div class="col-sm-6">
                <p class="my-2 text-secondary">{{ $room->capacity }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label for="capacity" class="col-sm-2 col-form-label text-md-right">Room Category</label>
            <div class="col-sm-8">
                <p class="my-2 text-secondary">{{ $room->room_category->name }}</p>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
            <a href="{{ route('room.edit', $room) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
