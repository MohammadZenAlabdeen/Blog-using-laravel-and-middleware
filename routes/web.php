<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
    Route::middleware(['can:viewAny,App\Models\Post'])->get('dashboard/posts/archive',[PostController::class,'showArchive'])->name('posts.showArchive');
    Route::middleware(['can:view,post'])->get('dashboard/posts/{post}',[PostController::class,'show'])->name('posts.show');
    Route::middleware(['can:delete,post'])->delete('dashboard/posts/archive/{post}',[PostController::class,'archive'])->name('posts.archive');
    Route::delete('dashboard/posts/forcedelete/{id}',[PostController::class,'destroy'])->name('posts.destroy');
    Route::put('dashboard/posts/restore/{id}',[PostController::class,'restore'])->name('posts.restore');
    
    Route::post('dashboard/logout',[UserController::class,'logout'])->name('logout');
    Route::middleware(['can:viewAny,App\Models\User'])->get('dashboard/users',[UserController::class,'showUsers'])->name('users.showAll');
    Route::middleware(['can:viewAny,App\Models\User'])->get('dashboard/users/trash',[UserController::class,'trash'])->name('users.trash');
    Route::middleware(['can:delete,user'])->delete('dashboard/users/delete/{user}',[UserController::class,'delete'])->name('users.delete');
    Route::delete('dashboard/users/destroy/{id}',[UserController::class, 'destroy'])->name('users.destroy');
    Route::middleware(['can:ban,user'])->put('dashboard/users/ban/{user}',[UserController::class,'ban'])->name('users.ban');
    Route::put('dashboard/users/restore/{id}',[UserController::class,'restore'])->name('users.restore');
    Route::put('dashboard/users/admin/{user}',[UserController::class,'makeAdmin'])->name('users.makeAdmin');

    Route::delete('dashboard/post/delete/{comment}',[CommentController::class,'destroy'])->name('comment.destroy');

    Route::middleware(['can:viewAny,App\Models\Tag'])->get('dashboard/tags',[TagController::class,'index'])->name('tags.index');
    Route::middleware(['can:create,App\Models\Tag'])->get('dashboard/createTag',[TagController::class,'create'])->name('tags.create');
    Route::middleware(['can:update,tag'])->get('dashboard/editTag/{tag}',[TagController::class,'edit'])->name('tags.edit');
    Route::post('dashboard/createTag/store',[TagController::class,'store'])->name('tags.store');
    Route::put('dashboard/editTag/update/{tag}',[TagController::class,'update'])->name('tags.update');
    Route::middleware(['can:delete,tag'])->delete('dashboard/deleteTag/{tag}',[TagController::class,'destroy'])->name('tags.destroy');

    Route::middleware(['can:viewAny,App\Models\Category'])->get('dashboard/categories',[CategoryController::class,'index'])->name('category.index');
    Route::middleware(['can:create,App\Models\Category'])->get('dashboard/createCategory',[CategoryController::class,'create'])->name('category.create');
    Route::middleware(['can:view,category'])->get('dashboard/showCategory/{category}',[CategoryController::class,'show'])->name('category.show');
    Route::middleware(['can:update,category'])->get('dashboard/editCategory/{category}',[CategoryController::class,'edit'])->name('category.edit');
    Route::post('dashboard/createCategory/store',[CategoryController::class,'store'])->name('category.store');
    Route::put('dashboard/editCategory/update/{category}',[CategoryController::class,'update'])->name('category.update');
    Route::middleware(['can:delete,category'])->delete('dashboard/deleteCategory/{category}',[CategoryController::class,'destroy'])->name('category.destroy');

    Route::middleware(['can:create,App\Models\User'])->get('dashboard/register', [UserController::class,'create'])->name('user.showregister');
    Route::middleware(['can:create,App\Models\User'])->post('dashboard/registered', [UserController::class,'register'])->name('user.register');
});
Route::middleware(['guest'])->group(function (){
    Route::get('/login', [UserController::class,'index'])->name('user.showlogin');
    Route::post('dashboard/logedin',[UserController::class,'login'])->name('login');
});


