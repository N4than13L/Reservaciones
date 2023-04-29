<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebasController;

//cargando controladores. 
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingtypeController;

// cargando middleware.
use App\Http\Middleware\ApiAuthMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return "<h1>Hola mundo</h1>";
});

// rutas de prueba.
Route::get('/test-orm', [PruebasController::class, 'testOrm']);
Route::get('/index', [PruebasController::class, 'index']);

// Rutas del A.P.I. rutas de prueba.
Route::get('/usuario/pruebas', [UserController::class, 'pruebas']);
Route::get('/tipo-reserva/pruebas', [BookingtypeController::class, 'pruebas']);
Route::get('/reserva/pruebas', [BookingController::class, 'pruebas']);

// Rutas del controlador de usuarios.
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);

Route::put('/api/user/update', [UserController::class, 'update']);

Route::post('/api/user/upload', [UserController::class, 'upload'])->middleware(ApiAuthMiddleware::class);

Route::get('/api/user/avatar/{filename}', [UserController::class, 'getimage']);

Route::get('/api/user/profile/{id}', [UserController::class, 'profile']);
