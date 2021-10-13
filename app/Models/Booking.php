<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relationships
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function booking_status()
    {
        return $this->belongsTo(BookingStatus::class)->withDefault(['name' => null]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
