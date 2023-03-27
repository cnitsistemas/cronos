<?php

use App\Http\Controllers\API\AlunosAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\FrequenciaAPIController;
use App\Http\Controllers\API\RotasAPIController;

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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [RegisterController::class, 'logout']);
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('rotas', RotasAPIController::class);
    Route::resource('alunos', AlunosAPIController::class);
    Route::resource('frequencias', FrequenciaAPIController::class);
});
