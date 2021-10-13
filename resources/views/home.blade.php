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
                <div class="card bg-primary text-light">
                    <div class="card-body">
                      <h5 class="card-title">{{ $count['user'] }} User</h5>
                      <p class="card-text">Total user</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-light">
                    <div class="card-body">
                      <h5 class="card-title">{{ $count['room'] }} Total Room</h5>
                      <p class="card-text">Total available room.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-light">
                    <div class="card-body">
                      <h5 class="card-title">{{ $count['booking'] }} Booking</h5>
                      <p class="card-text">Total active booking.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('styles')
<style>
</style>
@endpush

@push('scripts')
<script>
    // $(function () {
    //     alert()
    // })
</script>
@endpush