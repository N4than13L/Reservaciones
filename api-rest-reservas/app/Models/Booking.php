<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'Booking';

    // relacion de muchos a 1 (muchos a 1)  
    public function user()
    {
        return $this->belongsToMany('App\User', 'user_id');
    }

    public function booking_type()
    {
        return $this->belongsToMany('App\Booking_type', 'booking_id');
    }
}
