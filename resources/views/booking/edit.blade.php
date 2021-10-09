@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $booking->id ? "Edit Booking - $booking->applicant" : 'Create Booking' }}</div>

    <div class="card-body">
        <form id="booking-edit" action="{{ $booking->id ? route('booking.update', $booking) : route('booking.store') }}" method="post">
            @csrf
            @method($booking->id ? 'put' : 'post')
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">Applicant Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="applicant" name="applicant" value="{{ old('applicant', $booking->applicant) }}">
              </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Purpose</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="purpose" name="purpose" value="{{ old('purpose', $booking->purpose) }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Notes</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="notes" name="notes">{{ old('notes', $booking->notes) }}</textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Start At</label>
                <div class="col-sm-5">
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $booking->start_date_formatted) }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">End At</label>
                <div class="col-sm-5">
                  <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $booking->end_date_formatted) }}">
                </div>
            </div>

            <div class="form-group row">
              <label for="capacity" class="col-sm-2 col-form-label">Participant Total</label>
              <div class="col-sm-6">
                <input type="number" class="form-control" id="participant_total" name="participant_total" value="{{ old('participant_total', $booking->participant_total) }}">
              </div>
            </div>

            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Room</label>
                <div class="col-sm-8">
                    <select class="custom-select" id="room_id" name="room_id">
                        <option value="">Choose..</option>
                        @foreach ($rooms as $room)
                        <option value="{{ $room->id }}"
                            {{ $room->id == old('room_id', $booking->room_id) ? 'selected' : '' }}>
                            {{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if ($booking->id)
            <div class="form-group row">
                <label for="capacity" class="col-sm-2 col-form-label">Booking Status</label>
                <div class="col-sm-8">
                    <select class="custom-select" id="booking_status_id" name="booking_status_id">
                        <option value="">Choose..</option>
                        @foreach ($booking_statuses as $booking_status)
                        <option value="{{ $booking_status->id }}"
                            {{ $booking_status->id == old('booking_status_id', $booking->booking_status_id) ? 'selected' : '' }}>
                            {{ $booking_status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif

          <div class="d-flex justify-content-end">
              <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
              <button type="submit" class="btn btn-primary" form="booking-edit">Submit</button>
          </div>
        </form>
    </div>
</div>
@endsection
