<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Booking;
use App\Models\Booking_type;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Validator;

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
        $booking = Booking::find($id)->load('booking_type');

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

    public function store(Request $request)
    {
        // recoger datos por post.
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {
            // conseguir usuario identificado.
            $jwtAuth = new JwtAuth();
            $token = $request->header('Authorization', null);
            $user = $jwtAuth->checkToken($token, true);

            // validar datos.
            $validate = Validator::make($params_array, [
                'name' => 'required',
                'surname' => 'required',
                'booking_type_id' => 'required'
            ]);

            if ($validate->fails()) {
                $data = array(
                    "status" => "error",
                    "code" => 404,
                    "message" => "error al guardar reserva",
                    "error" => $validate->errors()
                );
            } else {
                // guardar reservacion. 
                $booking = new Booking();
                $booking->user_id = $user->sub;
                $booking->booking_type_id = $params->booking_type_id;
                $booking->name = $params->name;
                $booking->surname = $params->surname;
                $booking->bio = $params->bio;
                $booking->age = $params->age;
                $booking->nationality = $params->nationality;
                $booking->save();

                // devolver resultado.
                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "booking" => $booking,
                );
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => 404,
                "message" => "favor de enviar los datos correctamente",
            );
        }

        // devolver resultado en formato de json.
        return response()->json($data, $data['code']);
    }
}
