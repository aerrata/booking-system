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
                <p class="my-2 text-secondary">{{ $booking->start_date->format('d/m/Y g:i A') }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">End At</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->end_date->format('d/m/Y g:i A') }}</p>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Participant Total</label>
            <div class="col-sm-10">
                <p class="my-2 text-secondary">{{ $booking->participant_total }}</p>
            </div>
        </div>
        
        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Supporting Document</label>
            <div class="col-sm-10">
                @if ($booking->supporting_document_attachment)
                <p class="my-2">
                    <a href="{{ $booking->supporting_document_attachment->url }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="ti ti-download mr-1"></i>
                        {{ $booking->supporting_document_attachment->name }}
                    </a>
                </p>
                @else
                <p class="my-2 text-secondary">
                    No attachment
                </p>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-md-right">Room Name</label>
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

    </div>
    <div class="card-footer d-flex justify-content-end">
        <a href="{{ url()->previous() }}" class="btn btn-link btn-sm mr-2">Back</a>
        @if ($booking->booking_status_id === 1)
        <a href="{{ route('booking.edit', $booking) }}" class="btn btn-primary btn-sm">Edit</a>
        @endif
    </div>
</div>
@endsection
