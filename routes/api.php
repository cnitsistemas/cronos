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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [App\Http\Controllers\API\RegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\API\RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [App\Http\Controllers\API\RegisterController::class, 'logout']);
    Route::get('dashboard', [App\Http\Controllers\API\DashboardController::class, 'index']);
    Route::resource('rotas', App\Http\Controllers\API\RotasAPIController::class);
    Route::resource('alunos', App\Http\Controllers\API\AlunosAPIController::class);
    Route::resource('frequencias', App\Http\Controllers\API\FrequenciaAPIController::class);
});


Route::resource('frequencia-alunos', App\Http\Controllers\API\FrequenciaAlunoAPIController::class)
    ->except(['create', 'edit']);