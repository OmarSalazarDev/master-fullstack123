<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
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

// RUTAS DE PRUEBA
Route::get('/', function () {
    return '<h1>hola mundo con Laravel</h1>';
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/pruebas/{nombre}', function ($nombre) {

    $texto = '<h2>Texto desde una ruta</h2>';
    $texto .= 'Nombre: ' . $nombre;

    return view('/pruebas', array(
        'texto' => $texto
    ));
});

Route::get('/animales', [PruebasController::class, 'index']);
Route::get('/test-orm', [PruebasController::class, 'testOrm']);

// RUTAS DEL API

    // Metodos HTTP comunes
    /* 
        *GET: Conseguir datos o recursos.
        *POST: Guardar datos o recursos o hacer logica desde un formulario.
        *PUT: Actualizar datos o recursos.
        *DELETE: Eliminar datos o recursos.
    */

    // Rutas de prueba
    // Route::get('/usuario/pruebas', [UserController::class, 'pruebas']);
    // Route::get('/categoria/pruebas', [CategoryController::class, 'pruebas']);
    // Route::get('/entrada/pruebas', [PostController::class, 'pruebas']);

    // Rutas del controlador de usuarios
    Route::post('/api/register', [UserController::class, 'register']);
    Route::post('/api/login', [UserController::class, 'login']);
    // Route::post('/api/user/update', [UserController::class, 'update']);
    Route::put('/api/user/update', [UserController::class, 'update']);
    Route::post('/api/user/upload', [UserController::class, 'upload'])->middleware(ApiAuthMiddleware::class);
    Route::get('/api/user/avatar/{filename}', [UserController::class, 'getImage']);
    Route::get('/api/user/detail/{id}', [UserController::class, 'detail']);

    // Rutas del controlador de categorias
    Route::resource('/api/category', CategoryController::class);
