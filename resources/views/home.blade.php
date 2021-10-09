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

        {{ __('You are logged in!') }}
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