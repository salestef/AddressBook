<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('/')->middleware('guest');

Route::post('/login', [\App\Http\Controllers\SessionsController::class,'login'])->middleware('guest');

//Route::get('/logout', [\App\Http\Controllers\SessionsController::class,'logout'])->middleware('auth');
Route::get('/logout', [\App\Http\Controllers\SessionsController::class,'logout']);

Route::group(['middleware' => ['auth','admin']],function (){
//    Route::get('/admin', [\App\Http\Controllers\AdminController::class,'index']);
    Route::get('/admin', [\App\Http\Controllers\AdminController::class,'index']);
//    Route::get('/admin/agency/add', [\App\Http\Controllers\AdminController::class,'agencyAdd']);
//    Route::get('/admin/agency/{agency}', [\App\Http\Controllers\AdminController::class,'agencyEdit']);
    Route::get('/admin/agency/{method}', [\App\Http\Controllers\AdminController::class,'agency']);
    Route::get('/admin/contact/{method}', [\App\Http\Controllers\AdminController::class,'contact']);
});

Route::group(['middleware' => ['auth','contact']],function (){
    Route::get('/contact', [\App\Http\Controllers\ContactController::class,'index']);
});

