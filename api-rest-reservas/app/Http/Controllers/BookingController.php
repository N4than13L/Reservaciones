<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Booking;
use App\Models\Booking_type;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $bookings = Booking::all();

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'bookings' => $bookings
        ], 200);
    }

    public function show($id)
    {
        $booking = Booking::find($id);

        if (is_object($booking)) {
            $data = array(
                'status' => 'success',
                'code' => 200,
                'bookings' => $booking
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'bookings' => 'no hay reservas.'
            );
        }

        return response()->json($data, $data['code']);
    }
}
