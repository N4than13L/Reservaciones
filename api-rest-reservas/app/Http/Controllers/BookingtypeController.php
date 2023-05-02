<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Booking_type;

class BookingtypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('api.auth', ['except' => ['index', 'show']]);
    }

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

    public function store(Request $request)
    {
        // recoger datos por post.
        $json = $request->input('json', null); //objeto
        $params_array = json_decode($json, true); // array

        // validar datos si llegan los datos por el json.
        if (!empty($params_array)) {
            // validar los datos con validator
            $validate = Validator::make($params_array, [
                'name' => 'required'
            ]);

            // guardar los datos en la db.
            if ($validate->fails()) {
                $data = array(
                    'status' => 'error',
                    'code' => 400,
                    'message' => 'error no se ha podido guardar el tipo de reserva'
                );
            } else {
                $booking_type = new Booking_type();
                $booking_type->name = $params_array['name'];
                $booking_type->save();


                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'booking_type' => $booking_type
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 400,
                'message' => 'error, no has enviado la informacion.'
            );
        }


        // devolver resultado.
        return response()->json($data, $data['code']);
    }


    public function update($id, Request $request)
    {
        // recoger los datos por post.        
        $json = $request->input('json', null); //objeto
        $params_array = json_decode($json, true); // array

        // comprobar si los datos no estan nulos.
        if (!empty($params_array)) {
            // validar los datos.
            $validate = Validator::make($params_array, [
                'name' => 'required'
            ]);

            // quitar lo que no se van a actualizar.
            unset($params_array['id']);
            unset($params_array['created_at']);

            // actualizar el registro.
            $booking_type = Booking_type::where('id', $id)->update($params_array);

            $data = array(
                'status' => 'success',
                'code' => 200,
                'booking_type' => $booking_type,
                'change' => $params_array
            );
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'error, no has enviado la informacion para actualizar'
            );
        }

        return response()->json($data, $data['code']);
    }
}
