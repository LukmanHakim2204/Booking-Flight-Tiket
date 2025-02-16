<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FlightClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'flight_id',
        'class_type',
        'price',
        'total_price',
    ];
}