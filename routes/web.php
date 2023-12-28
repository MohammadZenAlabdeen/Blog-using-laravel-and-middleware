<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*guesst*/
Route::middleware(['auth'])->group(function(){
    Route::middleware(['can:viewAny,App\Models\Post'])->get('',[PostController::class,'index'])->name('posts.index');
    Route::middleware(['can:view,post'])->get('posts/{post}',[PostController::class,'show'])->name('posts.show');
    Route::middleware(['can:create,App\Models\Post'])->get('create',[PostController::class,'create'])->name('posts.create');
    Route::middleware(['can:create,App\Models\Post'])->post('posts',[PostController::class,'store'])->name('posts.store');
    Route::middleware(['can:update,post'])->get('posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::middleware(['can:update,post'])->put('posts/{post}',[PostController::class,'update'])->name('posts.update');
    Route::middleware(['can:delete,post'])->delete('posts/{post}',[PostController::class,'destroy'])->name('posts.destroy');
    Route::post('logout',[UserController::class,'logout'])->name('logout');

    Route::middleware(['can:view,post'])->post('post/{post}/comment',[CommentController::class,'store'])->name('comment.store');
    Route::get('post/{comment}/edit',[CommentController::class,'edit'])->name('comment.edit');
    Route::put('post/{comment}',[CommentController::class,'update'])->name('comment.update');
    Route::delete('post/delete/{comment}',[CommentController::class,'destroy'])->name('comment.destroy');

    Route::get('tags',[TagController::class,'index'])->name('tags.index');
    Route::get('createTag',[TagController::class,'create'])->name('tags.create');
    Route::get('editTag/{tag}',[TagController::class,'edit'])->name('tags.edit');
    Route::post('createTag/store',[TagController::class,'store'])->name('tags.store');
    Route::put('editTag/update/{tag}',[TagController::class,'update'])->name('tags.update');
    Route::delete('deleteTag/{tag}',[TagController::class,'destroy'])->name('tags.destroy');

    Route::get('categories',[CategoryController::class,'index'])->name('category.index');
    Route::get('createCategory',[CategoryController::class,'create'])->name('category.create');
    Route::get('showCategory/{category}',[CategoryController::class,'show'])->name('category.show');
    Route::get('editCategory/{category}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('createCategory/store',[CategoryController::class,'store'])->name('category.store');
    Route::put('editCategory/update/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('deleteCategory/{category}',[CategoryController::class,'destroy'])->name('category.destroy');
});
Route::middleware(['guest'])->group(function (){
    Route::get('/login', [UserController::class,'index'])->name('user.showlogin');
    Route::post('/logedin',[UserController::class,'login'])->name('login');
    Route::get('/register', [UserController::class,'create'])->name('user.showregister');
    Route::post('/registered', [UserController::class,'store'])->name('user.store');
});


