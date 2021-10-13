@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
                @if ($userCountPartialCache)
                    {!! $userCountPartialCache !!}
                @else
                <include-fragment src="{{ route('home.partialUserCount') }}">
                    <x-spinner />
                </include-fragment>
                @endif
            </div>
            <div class="col-md-4">
                @if ($roomCountPartialCache)
                    {!! $roomCountPartialCache !!}
                @else
                <include-fragment src="{{ route('home.partialRoomCount') }}">
                    <x-spinner />
                </include-fragment>
                @endif
            </div>
            <div class="col-md-4">
                @if ($bookingCountPartialCache)
                    {!! $bookingCountPartialCache !!}
                @else
                <include-fragment src="{{ route('home.partialBookingCount') }}">
                    <x-spinner />
                </include-fragment>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
