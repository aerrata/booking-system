<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

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

    public function getSupportingDocumentAttachmentAttribute()
    {
        return $this->getFirstMedia()
            ? (object) collect([
                'name' => $this->getFirstMedia()->file_name,
                'url' => $this->getFirstMedia()->getUrl()
            ])->all()
            : null;
    }
}
