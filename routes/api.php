<?php

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

Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'getAll']);
Route::get('/projects/{id}', [\App\Http\Controllers\ProjectController::class, 'getOne']);
Route::post('/projects', [\App\Http\Controllers\ProjectController::class, 'store']);
Route::put('/projects/{id}', [\App\Http\Controllers\ProjectController::class, 'update']);

Route::get('/todos', [\App\Http\Controllers\TodoController::class, 'getAll']);
Route::get('/todos/{id}', [\App\Http\Controllers\TodoController::class, 'getOne']);
Route::post('/todos', [\App\Http\Controllers\TodoController::class, 'store']);
Route::put('/todos/{id}', [\App\Http\Controllers\TodoController::class, 'update']);
Route::delete('/todos/{id}', [\App\Http\Controllers\TodoController::class, 'delete']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
