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
Route::post('/para/{number}', 'HomeController@index');

Route::post('/login', 'Auth\RegisterController@login');
Route::middleware('auth:sanctum')->group( function () {
    Route::resource('patient', PatientController::class);

});




