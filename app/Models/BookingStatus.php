<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    use HasFactory;
    
    const DALAM_PROSES = 1;
    const LULUS = 2;
    const TIDAK_LULUS = 3;

    protected $guarded = [];
}
