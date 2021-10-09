@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">Bookings</div>

    <div class="card-body">
        <div class="mb-3">
            <div id="calendar"></div>
        </div>
        <a href="{{ route('booking.create') }}" class="btn btn-primary">New</a>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="eventModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>

<script>
    $(function () {
        var calendarEl = document.getElementById("calendar")
        var bookings = {!! json_encode($bookings) !!}
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'prev,today,next',
                center: 'title',
                end: 'dayGridMonth,dayGridWeek,listWeek'
            },
            eventTimeFormat: {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            },
            events: bookings,
            // eventClick: function(event){
            //     $('#eventModal').modal()
            // },
        });

        setTimeout(function(){
            calendar.render()
        })
    });
</script>

@endpush

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.css" rel="stylesheet" />
@endpush
