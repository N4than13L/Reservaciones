<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Booking_type;

class BookingtypeController extends Controller
{

    public function index()
    {
        $booking_type = Booking_type::all();

        return response()->json([
            'status' => "success",
            "code" => 200,
            'booking_type' => $booking_type
        ]);
    }

    public function show($id)
    {
        $booking_type = Booking_type::find($id);

        if (is_object($booking_type)) {
            return response()->json([
                'status' => "success",
                "code" => 200,
                'booking_type' => $booking_type
            ]);
        } else {
            return response()->json([
                'status' => "Error",
                "code" => 404,
                'message' => "error tipo de reserva no encontrada"
            ]);
        }
    }
}
