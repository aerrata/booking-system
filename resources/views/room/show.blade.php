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

    </div>
    <div class="card-footer d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-link btn-sm mr-2">Back</a>
        <a href="{{ route('room.edit', $room) }}" class="btn btn-primary btn-sm">Edit</a>
    </div>
</div>
@endsection
