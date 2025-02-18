<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/form',[UserController::class,'formUI']);
Route::post('/form',[UserController::class,'store'])->name('form');
//;
