<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CategoryApiController;
use App\Http\Controllers\api\CommentApiController;
use App\Http\Controllers\api\PostApiController;
use App\Http\Controllers\api\TagApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group( function (){
    Route::post('/logout',[AuthController::class,'logout']);
    
    Route::post('/post/store',[PostApiController::class,'store']);
    Route::get('/post/index',[PostApiController::class,'index']);
    Route::get('/post/show/{id}',[PostApiController::class,'show']);
    Route::put('/post/update/{id}',[PostApiController::class,'update']);
    Route::delete('/post/delete/{id}',[PostApiController::class,'destroy']);

    Route::post('/post/{id}/comment',[CommentApiController::class,'store']);
    Route::put('/comment/update/{id}',[CommentApiController::class,'update']);
    Route::delete('/comment/delete/{id}',[CommentApiController::class,'destroy']);

    Route::get('/category',[CategoryApiController::class,'index']);
    Route::get('/tag',[TagApiController::class,'index']);
});



