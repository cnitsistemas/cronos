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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [App\Http\Controllers\API\RegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\API\RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [App\Http\Controllers\API\RegisterController::class, 'logout']);
    Route::get('dashboard', [App\Http\Controllers\API\DashboardController::class, 'index']);
    Route::resource('rotas', App\Http\Controllers\API\RotasAPIController::class);
    Route::resource('alunos', App\Http\Controllers\API\AlunosAPIController::class);


    //ACL
    Route::resource('roles', App\Http\Controllers\API\RolesAPIController::class);
    Route::resource('permissions', App\Http\Controllers\API\PermissionsAPIController::class);
    Route::get('permissions-all', [App\Http\Controllers\API\PermissionsAPIController::class, 'all']);
    Route::get('roles-all', [App\Http\Controllers\API\RolesAPIController::class, 'all']);
    Route::resource('users', App\Http\Controllers\API\UserAPIController::class);
    Route::post('user-role/{id}', [App\Http\Controllers\API\UserAPIController::class, 'applyRoleToUser']);
});

Route::resource('frequencias', App\Http\Controllers\API\FrequenciaAPIController::class);
Route::get('frequencia-detalhe/{id}', [App\Http\Controllers\API\FrequenciaAPIController::class, 'frequency']);
Route::put('frequencia/{id}', [App\Http\Controllers\API\FrequenciaAPIController::class, 'makeFrequency']);

Route::resource('frequencia-alunos', App\Http\Controllers\API\FrequenciaAlunoAPIController::class)
    ->except(['create', 'edit']);


Route::resource('veiculos', App\Http\Controllers\API\VeiculosAPIController::class)
    ->except(['create', 'edit']);

Route::resource('condutores', App\Http\Controllers\API\CondutoresAPIController::class)
    ->except(['create', 'edit']);