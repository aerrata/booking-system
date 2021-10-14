@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">{{ $booking->id ? "Edit Booking - $booking->applicant" : 'Create Booking' }}</div>

    <div class="card-body">
        <form id="booking-edit" action="{{ $booking->id ? route('booking.update', $booking) : route('booking.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method($booking->id ? 'put' : 'post')
            <div class="form-group row">
              <label for="applicant" class="col-sm-2 col-form-label text-md-right">Applicant Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control @error('applicant') is-invalid @enderror" id="applicant" name="applicant" value="{{ old('applicant', $booking->applicant) }}">
                
                @error('applicant')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
                <label for="purpose" class="col-sm-2 col-form-label text-md-right">Purpose</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" value="{{ old('purpose', $booking->purpose) }}">
                    
                    @error('purpose')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="notes" class="col-sm-2 col-form-label text-md-right">Notes</label>
                <div class="col-sm-10">
                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes">{{ old('notes', $booking->notes) }}</textarea>
                    @error('notes')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="start_date" class="col-sm-2 col-form-label text-md-right">Start At</label>
                <div class="col-sm-5">
                    <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', optional($booking->start_date)->format('Y-m-d\TH:i')) }}">
                    
                    @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="end_date" class="col-sm-2 col-form-label text-md-right">End At</label>
                <div class="col-sm-5">
                    <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', optional($booking->end_date)->format('Y-m-d\TH:i')) }}">
                        
                    @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="participant_total" class="col-sm-2 col-form-label text-md-right">Participant Total</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control @error('participant_total') is-invalid @enderror" id="participant_total" name="participant_total" value="{{ old('participant_total', $booking->participant_total) }}">
                    
                    @error('participant_total')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="supporting_document_attachment" class="col-sm-2 col-form-label text-md-right">Supporting Document (.pdf)</label>
                <div class="col-sm-6">
                    @if ($booking->supporting_document_attachment)
                    <p class="my-2">
                        <a href="{{ $booking->supporting_document_attachment->url }}" target="_blank" class="btn btn-primary btn-sm">
                            <i class="ti ti-download mr-1"></i>
                            {{ $booking->supporting_document_attachment->name }}
                        </a>
                    </p>
                    @endif
                    
                    <input type="file" class="form-control @error('supporting_document_attachment') is-invalid @enderror" id="supporting_document_attachment" name="supporting_document_attachment">
                    
                    @error('supporting_document_attachment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="room_id" class="col-sm-2 col-form-label text-md-right">Room</label>
                <div class="col-sm-8">
                    <select class="custom-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id">
                        <option value="">Choose..</option>
                        @foreach ($rooms as $room)
                        <option value="{{ $room->id }}"
                            {{ $room->id == old('room_id', $booking->room_id) ? 'selected' : '' }}>
                            {{ $room->name }}</option>
                        @endforeach
                    </select>

                    @error('room_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            @if ($booking->id)
                @can ('approve_booking')
                <div class="form-group row">
                    <label for="booking_status_id" class="col-sm-2 col-form-label text-md-right">Booking Status</label>
                    <div class="col-sm-8">
                        <select class="custom-select @error('booking_status_id') is-invalid @enderror" id="booking_status_id" name="booking_status_id">
                            <option value="">Choose..</option>
                            @foreach ($booking_statuses as $booking_status)
                            <option value="{{ $booking_status->id }}"
                                {{ $booking_status->id == old('booking_status_id', $booking->booking_status_id) ? 'selected' : '' }}>
                                {{ $booking_status->name }}</option>
                            @endforeach
                        </select>

                        @error('booking_status_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                @endcan
            @endif

          <div class="d-flex justify-content-end">
              <a href="{{ url()->previous() }}" class="btn btn-link mr-2">Cancel</a>
              <button type="submit" class="btn btn-primary" form="booking-edit">Submit</button>
          </div>
        </form>
    </div>
</div>
@endsection
