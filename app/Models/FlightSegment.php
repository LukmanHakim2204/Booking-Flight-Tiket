<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightSegment extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'squence',
        'flight_id',
        'airport_id',
        'time',
    ];
}