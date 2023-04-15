<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Booking_type;

class PruebasController extends Controller
{
    public function index()
    {
        echo "<h1>Pruebas controller</h1>";
    }

    // probando el ORM.
    public function testOrm()
    {
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            // echo "<span></span>" . $booking->users->name;
            echo "<h1>" . $booking->name . " " . $booking->surname .  "</h1>";
        }


        die();
    }
}
