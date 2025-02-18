<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoCode extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable =
    [
        'code',
        'discount_type',
        'discount',
        'valid_until',
        'is_used',
    ];


    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}