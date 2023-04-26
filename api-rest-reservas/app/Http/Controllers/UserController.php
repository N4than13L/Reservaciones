<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Helpers\JwtAuth;

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
                "email" => "required|email|unique:users",
                "password" => "required"
            ]);

            if ($validate->fails()) {
                $data = array(
                    "status" => "error",
                    "code" => 404,
                    "message" => "error al registrar, datos mal escritos o faltan datos",
                    "error" => $validate->errors()
                );
                return response()->json($data, $data['code']);
            } else {
                // validar datos.
                // cifrar la contraseña. 
                $pwd = hash('sha256', $params->password);

                // comprobar si el usuario existe.
                $user = new User();

                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = "ROLE_USER";

                // crear usuario.
                $user->save();

                $data = array(
                    "status" => "success",
                    "code" => 200,
                    "message" => "usuario creado exitosamente",
                    "user" => $user
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
        $jwtAuth = new JwtAuth();

        // recoger datos por post.
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        // validar datos.
        $validate = Validator::make($params_array, [
            "email" => "required|email",
            "password" => "required"
        ]);

        if ($validate->fails()) {
            $signup = array(
                "status" => "error",
                "code" => 404,
                "message" => "Error no te has podido logear",
                "error" => $validate->errors()
            );
        } else {
            // cifrar la contrasena.
            $pwd = hash('sha256', $params->password);

            // devolver token o datos.
            $signup = $jwtAuth->signup($params->email, $pwd);

            if (!empty($params->getToken)) {
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }
        }

        return response()->json($signup, 200);
    }

    public function update(Request $request)
    {
        // comprobar si el usuario esta identificado.
        $token = $request->header('Authorization');
        $jwtAuth = new JwtAuth();
        $checkToken = $jwtAuth->checkToken($token);

        // recoger los datos del post.
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if ($checkToken && !empty($params_array)) {

            // sacar datos del usuario identificado.
            $user = $jwtAuth->checkToken($token, true);

            // validar los datos.
            $validate = Validator::make($params_array, [
                "name" => "required|alpha",
                "surname" => "required|alpha",
                'email' => 'required|email|unique:users,' . $user->sub
            ]);

            // quitar los campos no actualizables.
            unset($params_array['id']);
            unset($params_array['role']);
            unset($params_array['password']);
            unset($params_array['created_at']);
            unset($params_array['updated_at']);
            unset($params_array['remember_token']);

            // actualizar en la db.
            $user_update = User::where('id', $user->sub)->update($params_array);

            // devolver array con el resultado.
            $data = array(
                "status" => "success",
                "code" => 200,
                "user" => $user,
                "change" => $params_array
            );
        } else {
            $data = array(
                "status" => "error",
                "code" => 500,
                "message" => "usuario no identificado.",
            );
        }

        return response()->json($data, $data['code']);
    }

    public function upload(Request $request)
    {
        $data = array(
            "status" => "succes",
            "code" => 200,
            "message" => "funcion de subir imagenes.",
        );

        return response()->json($data, $data['code']);
    }
}
