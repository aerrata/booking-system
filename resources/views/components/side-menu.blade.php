<div class="nav flex-column nav-pills mb-4">
    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'home') === 0) ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="ti ti-home mr-1"></i>
        Dashboard
    </a>
    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'room') === 0) ? 'active' : '' }}" href="{{ route('room.index') }}">
        <i class="ti ti-bed mr-1"></i>
        Room
    </a>
    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'booking') === 0) ? 'active' : '' }}" href="{{ route('booking.index') }}">
        <i class="ti ti-bookmarks mr-1"></i>
        Bookings
    </a>
</div>
