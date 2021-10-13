@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">Bookings</div>

    <div class="card-body">
        @if (request()->query('view') === 'calendar')
        <a href="{{ route('booking.index', ['view' => 'table']) }}" class="btn btn-primary mb-3">
            <i class="ti ti-table mr-1"></i> Table View
        </a>
        @else
        <a href="{{ route('booking.index', ['view' => 'calendar']) }}" class="btn btn-primary mb-3">
            <i class="ti ti-calendar mr-1"></i> Calendar View
        </a>
        @endif

        @includeWhen((request()->query('view') === 'table' || request()->query('view') === null), 'room._table-view', ['bookings' => $bookings])
        @includeWhen(request()->query('view') === 'calendar', 'room._calendar-view', ['bookings' => $bookings])
        
        <a href="{{ route('booking.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i>
            New
        </a>
    </div>
</div>
@endsection

