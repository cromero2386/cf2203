<?php

use App\Http\Controllers\AreaController;
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
