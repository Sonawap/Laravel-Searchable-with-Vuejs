<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//create user
Route::post('/register', [AuthController::class, 'store']);

//login
Route::post('/login', [AuthController::class, 'login']);

//users
Route::get('/', [AuthController::class, 'index']);


Route::group(['middleware' => 'auth:sanctum', 'namespace' => 'App\Http\Controllers\API'], function() {

    //Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //User
    Route::get('user', function(Request $request) {
        return $request->user();
    });

    //Update
    Route::put('/users/{id}', [AuthController::class, 'update']);

    //Delete
    Route::delete('/users/{id}', [AuthController::class, 'destroy']);


});


