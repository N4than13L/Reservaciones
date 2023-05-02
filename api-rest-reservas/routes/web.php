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

// Rutas del controlador de usuarios.
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);

Route::put('api/user/update', [UserController::class, 'update']);

Route::post('/api/user/upload', [UserController::class, 'upload'])->middleware(ApiAuthMiddleware::class);

Route::get('/api/user/avatar/{filename}', [UserController::class, 'getimage']);

Route::get('/api/user/profile/{id}', [UserController::class, 'profile']);


// parte de categorias.
Route::resource('/api/booking_type', BookingtypeController::class);
