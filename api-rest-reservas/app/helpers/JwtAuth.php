<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Firebase\JWT\Key;

class JwtAuth
{
    public $key;

    public function __construct()
    {
        $this->key = "esto_es_una_llave_secreta-1234";
    }
    public function signup($email, $password, $getToken = null)
    {
        // Buscar si el usuario tiene sus credenciales.
        $user = User::where([
            'email' => $email,
            'password' => $password
        ])->first();

        // Comprobar si son concretas.
        $signup = false;
        if (is_object($user)) {
            $signup = true;
        }

        // Generar un token con los datos de usuario identificado.
        if ($signup) {
            $token = array(
                'sub' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
                'surname' => $user->surname,
                'iat' => time(),
                'exp' => time() + (7 * 24 * 60)
            );

            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);

            if (is_null($getToken)) {
                $data =  $jwt;
            } else {
                $data = $decoded;
            }
        } else {
            $data = array(
                "status" => "error",
                "message" => "error, loggin incorrecto",
            );
        }

        // devolver datos decodificados o el token, en fucncion de un parametro.
        return $data;
    }

    public function checkToken($jwt, $getIdentity = false)
    {
        $auth = false;

        try {
            // remplazar las comillas por nada.
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $do) {
            $auth = false;
        }
        if (!empty($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        if ($getIdentity) {
            return $decoded;
        }

        return $auth;
    }
}
