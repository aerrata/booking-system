@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">Bookings</div>

    <div class="card-body">
        @includeWhen($table, 'room._table-view', ['bookings' => $bookings])
        @includeUnless($table, 'room._calendar-view', ['bookings' => $bookings])
    </div>
</div>
@endsection

