<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Applicant</th>
            <th>Room</th>
            <th>Purpose</th>
            <th>Start At</th>
            <th>End At</th>
            <th>Booking Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $booking)
        <tr>
            <th>
                {{ $loop->iteration + $bookings->firstItem() - 1 }}
            </th>
            <td>{{ $booking->applicant }}</td>
            <td>{{ optional($booking->room)->name }}</td>
            <td>{{ $booking->purpose }}</td>
            <td>{{ $booking->start_date->format('d/m/Y g:i A') }}</td>
            <td>{{ $booking->end_date->format('d/m/Y g:i A') }}</td>
            <td>{{ optional($booking->booking_status)->name }}</td>
            <td>
                <form id="form-booking-destroy-{{ $booking->id }}" action="{{ route('booking.destroy', $booking) }}" method="POST">
                    @csrf
                    @method('delete')
                </form>
                <a class="btn btn-sm btn-link" href="{{ route('booking.edit', $booking) }}">Edit</a>
                <button type="submit" class="btn btn-sm btn-link" form="form-booking-destroy-{{ $booking->id }}" onclick="return confirm('Are you sure?')">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $bookings->links() }}

<a href="{{ route('booking.create') }}" class="btn btn-primary">New</a>


