<div class="nav flex-column nav-pills mb-4">
    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'home') === 0) ? 'active' : '' }}" href="{{ route('home') }}">
        <span class="ti ti-home mr-1"></span>
        Dashboard
    </a>
    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'room') === 0) ? 'active' : '' }}" href="{{ route('room.index') }}">
        <span class="ti ti-bed mr-1"></span>
        Room
    </a>
    <a class="nav-link {{ (strpos(Route::currentRouteName(), 'booking') === 0) ? 'active' : '' }}" href="{{ route('booking.index') }}">
        <span class="ti ti-bookmarks mr-1"></span>
        Bookings
    </a>
</div>
