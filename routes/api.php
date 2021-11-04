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



Route::resource('agencies', \App\Http\Controllers\AgencyController::class);
Route::get('/agencies/search/{name}',[\App\Http\Controllers\AgencyController::class,'search']);
Route::get('/agencies/contacts/{id}',[\App\Http\Controllers\AgencyController::class,'agencyContacts']);

Route::resource('users', \App\Http\Controllers\UserController::class);
Route::get('/users/search/{name}',[\App\Http\Controllers\UserController::class,'search']);
//Route::get('/agencies',[\App\Http\Controllers\AgencyController::class,'index']);
//Route::post('/agencies',[\App\Http\Controllers\AgencyController::class,'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
