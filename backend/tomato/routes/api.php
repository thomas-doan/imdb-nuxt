<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\ComsController;

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

//USERS
//routes pour afficher les users
    Route::get('/users', [userController::class, 'index']);
Route::get('/users/{id}', [userController::class, 'show']);

//Commentaires
Route::get('/com', [ComsController::class, 'index']);
Route::get('/com/{id}', [ComsController::class, 'show']);
Route::get('/com/user/{id}', [ComsController::class, 'oneUser']);
Route::post('/com/user', [ComsController::class, 'oneUser']);
Route::get('/movies/com/{id}', [ComsController::class, 'MovieUser']);



Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::put('/com/{id}', [comsController::class, 'update']);
    Route::delete('/com/{id}', [comsController::class, 'destroy']);
    Route::post('/com', [ComsController::class, 'store']);

    //modifier un utilisateur
    Route::put('/users/{id}', [userController::class, 'update']);
    
    //routes pour créer un USERS
    Route::post('/users', [userController::class, 'store']);
    Route::get('/users/{id}', [userController::class, 'show']);

    //routes pour delete un user
    Route::delete('/users/{id}', [userController::class, 'destroy']);

    //modifier un USER mdp etc
    Route::put('/user/{id}', [\App\Http\Controllers\AuthController::class, 'update']);

    
    // Afficher un USER
    
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);

    //DELETE USER
    Route::delete('/user/{id}', [\App\Http\Controllers\AuthController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', [\App\Http\Controllers\AuthController::class, 'user']);
});
