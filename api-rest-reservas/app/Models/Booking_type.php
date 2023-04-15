<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking_type extends Model
{
    protected $table = 'Booking_type';

    // relacion de 1 a muchos 
    public function booking_type()
    {
        return $this->hasMany('App\Booking');
    }
}
