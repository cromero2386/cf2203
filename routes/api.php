<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProvinciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Area
 */
// Listar todos
Route::get('getAllAreas', [AreaController::class, 'index']);
// Listar un area
Route::get('getArea/{id}', [AreaController::class, 'show']);
// Registrar un area
Route::post('postArea', [AreaController::class, 'store']);
// Actualizar un area
Route::put('updateArea', [AreaController::class, 'update']);
// borrar un area
Route::delete('borrarArea/{id}', [AreaController::class, 'destroy']);

/**
 * Provincia
 */
Route::post('insertProvincias', [ProvinciaController::class, 'store']);
// Listar todas las provincias
Route::get('getAllProvincias', [ProvinciaController::class, 'index']);
// Listar un provincia
Route::get('getProvincia/{id}', [ProvinciaController::class, 'show']);

/**
 * Localidad
 */
// Listar todos
Route::get('getAllLocalidades', [LocalidadController::class, 'index']);
// Listar una localidad
Route::get('getLocalidad/{id}', [LocalidadController::class, 'show']);
// Registrar una localidad
Route::post('postLocalidad', [LocalidadController::class, 'store']);
// Actualizar una localidad
Route::put('updateLocalidad', [LocalidadController::class, 'update']);
// borrar una localidad
Route::delete('borrarLocalidad/{id}', [LocalidadController::class, 'destroy']);

/**
 * Barrio
 */
// Listar todos
Route::get('getAllBarrios', [BarrioController::class, 'index']);
// Listar un barrio
Route::get('getBarrio/{id}', [BarrioController::class, 'show']);
// Registrar un barrio
Route::post('postBarrio', [BarrioController::class, 'store']);
// Actualizar un barrio
Route::put('updateBarrio', [BarrioController::class, 'update']);
// borrar un barrio
Route::delete('borrarBarrio/{id}', [BarrioController::class, 'destroy']);

/**
 * Persona
 */
// Listar todos
Route::get('getAllPersonas', [PersonaController::class, 'index']);
// Listar una persona
Route::get('getPersona/{id}', [PersonaController::class, 'show']);
// Registrar una persona
Route::post('postPersona', [PersonaController::class, 'store']);
// Actualizar una persona
Route::put('updatePersona', [PersonaController::class, 'update']);
// borrar una persona
Route::delete('borrarPersona/{id}', [PersonaController::class, 'destroy']);
//este es un comentario