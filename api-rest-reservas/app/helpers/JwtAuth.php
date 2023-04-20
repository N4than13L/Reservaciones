<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class JwtAuth
{
    public function signup()
    {
        // Buscar si el usuario tiene sus credenciales.
        // si son concretas.
        // Generar un token con los datos de usuario identificado.
        // devolver datos decodificados o el token, en fucncion de un parametro.

        return "metodo de la clase jwt auth";
    }
}
