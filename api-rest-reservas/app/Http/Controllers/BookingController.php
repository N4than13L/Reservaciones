<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Booking;
use App\Models\Booking_type;
use App\Helpers\JwtAuth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.auth', ['except' =>
        [
            'index',
            'show',
            'getBoookingsByBookingType',
            'getBookingsByUser'
        ]]);
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
            $user = $this->getIdentity($request);

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

    public function update($id, Request $request)
    {
        // comprobar usuario identificado.
        $user = $this->getIdentity($request);

        // recoger los datos por post.
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);


        if (!empty($params_array)) {
            // validar los datos.
            $validate = Validator::make($params_array, [
                'name' => "reqiured",
                'surname' => "required",
                'booking_type_id' => 'required'
            ]);

            // eliminar lo que no se actualizara.
            unset($params_array['id']);
            unset($params_array['user_id']);
            unset($params_array['created_at']);
            unset($params_array['user']);


            // actualizar el registro.
            $booking = Booking::where('id', $id)->update($params_array);

            // devolver un resultado.
            $data = array(
                "status" => "success",
                "code" => 200,
                "booking" => $booking,
                "changes" => $params_array,
            );
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "message" => "faltan datos por enviar",
            );
        }

        return response()->json($data, $data['code']);
    }

    public function destroy($id, Request $request)
    {
        // comprobar usuario identificado.
        $user = $this->getIdentity($request);

        // comprobar si existe el registro
        $booking = Booking::find($id)
            ->where('user_id', $user->sub)->first();

        // comprobar si no esta nulo el parametro.
        if (!empty($booking)) {
            // borrar si existe
            $booking->delete();

            // devolver algo
            $data = array(
                "status" => "success",
                "code" => 200,
                "message" => "reserva eliminada exitosamente",
                "booking" => $booking,
            );
        } else {
            $data = array(
                "status" => "error",
                "code" => 400,
                "message" => "no se encuentra la reservacion a eliminar",
            );
        }

        return response()->json($data, $data['code']);
    }

    public function getBoookingsByBookingType($id)
    {
        $bookings = Booking::where('booking_type_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'bookings_by_booking_type' => $bookings
        ], 200);
    }

    public function getBookingsByUser($id)
    {
        $bookings = Booking::where('user_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'bookings_by_user' => $bookings
        ], 200);
    }

    private function getIdentity(Request $request)
    {
        $jwtAuth = new JwtAuth($request);
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);

        return $user;
    }
}
