<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Booking_type extends Model
{
    protected $table = 'booking_type';

    // relacion de 1 a muchos 
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
