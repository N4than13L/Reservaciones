<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function pruebas(Request $request)
    {
        return "Accion de pruebas de userController";
    }

    public function register(Request $request)
    {
        // recoger los datos de usuario por post.
        $json = $request->input('json', null);
        $params = json_decode($json); //objeto
        $params_array = json_decode($json, true); // array

        if (!empty($params) && !empty($params_array)) {
            // limpiar datos del array.
            $params_array = array_map('trim', $params_array);

            $validate = Validator::make($params_array, [
                "name" => "required|alpha",
                "surname" => "required|alpha",
                "email" => "required|email",
                "password" => "required"
            ]);

            if ($validate->fails()) {
                $data = array(
                    "status" => "sucess",
                    "code" => 404,
                    "message" => "error al registrar, datos mal escritos o faltan datos",
                    "error" => $validate->errors()
                );
                return response()->json($data, $data['code']);
            } else {
                // validacion pasada correctamente sugue lo sigte:
                // validar datos.
                // cifrar la contraseña. 
                // comprobar si el usuario existe.
                // crear usuario.

                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "message" => "usuario creado exitosamente",
                );
            }
        } else {
            $data = array(
                "status" => "error",
                "code" => 404,
                "message" => "los datos enviados son incorrectos",
            );
        }



        return response()->json($data, $data['code']);
    }

    public function login(Request $request)
    {
        return "accion de login";
    }
}
