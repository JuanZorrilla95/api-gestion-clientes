<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clients', [ClientController::class, 'index']);
Route::get('/clients/{id}', [ClientController::class, 'show']);

//obtiene todos los clientes
Route::get('/clients', [ClientController::class, 'getAll']);
// obtiene un cliente específico por ID
Route::get('/clients/{id}', [ClientController::class, 'get']);

Route::get('/clients/search', [ClientController::class, 'search']);
Route::post('/clients', [ClientController::class, 'store']);
Route::put('/clients/{id}', [ClientController::class, 'update']);

//las pruebas las hice en Postman.