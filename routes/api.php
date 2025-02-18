<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::prefix('user')->group(function(){
    Route::get('/',[UserController::class,'index']);
    // Route::post('/store',[UserController::class,'store']);
    Route::get('/{user}',[UserController::class,'show']);
    Route::post('/update/{user}', [UserController::class, 'update']);
    Route::delete('/{user_id}',[UserController::class, 'destroy']);
});

Route::prefix('book')->group(function(){
    Route::get('/',[BooksController::class , 'index']);
    Route::post('/',[BooksController::class,'store']);
    Route::get('/{book_id}',[BooksController::class, 'show']);
    Route::post('/update/{book_id}',[BooksController::class, 'update']);
    Route::delete('/{book_id}', [BooksController::class, 'destroy']);
});

Route::get('/user/book/{user_id}',[UserController::class, 'showbook']);
Route::post('/course/{std_id}',[StudentController::class,'attach_student_with_associated_courses']);
// Route::get('/student/{id}',[StudentController::class,'get_student_of_specific_course_by_id']);
Route::get('/student/{student}',[StudentController::class,'student']);


Route::post('/login', [AuthController::class,'AdminLogin']);

Route::middleware(['auth:sanctum','checkAdmin'])->group(function(){
       Route::get('/user_data',[AuthController::class,'index']);
});
