        <div class="mb-3">
            <div id="calendar"></div>
        </div>
        <a href="{{ route('booking.create') }}" class="btn btn-primary">New</a>
    </div>
</div>

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
