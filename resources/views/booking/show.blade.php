@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $booking->applicant }}</div>

    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Applicant Name</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->applicant }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Purpose</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->purpose }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Notes</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->notes }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Start At</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->start_date }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">End At</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->end_date }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Participant Total</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->participant_total }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Room</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->room->name }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Booking Status</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->booking_status->name }}</p>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
            <a href="{{ route('booking.edit', $booking) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
