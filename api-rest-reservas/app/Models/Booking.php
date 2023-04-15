<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Booking_type;

class Booking extends Model
{
    protected $table = 'Booking';

    // relacion muchos a 1 e inversa (muchos a 1). 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // relacion muchos a 1.
    public function booking_type()
    {
        return $this->belongsToMany(Booking_type::class, 'booking_id');
    }
}
