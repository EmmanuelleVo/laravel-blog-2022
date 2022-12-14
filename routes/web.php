<?php

use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterSessionController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|it
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth')->can('create' ,Post::class);
Route::post('/posts/create', [PostController::class, 'store'])->middleware('auth')->can('create', Post::class);
Route::get('/posts/{post:slug}', [PostController::class, 'show']);
Route::get('/posts/edit/{post:slug}', [PostController::class, 'edit'])->middleware('auth')->can('update', 'post');
Route::patch('/posts/edit/{post:slug}', [PostController::class, 'update'])->middleware('auth')->can('update', 'post');
Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->middleware('auth')->can('delete', 'post');

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

Route::get('/authors', [UserController::class, 'index']);
Route::get('/authors/{user:slug}', [UserController::class, 'show']);

Route::get('/posts/{post:slug}/comments', [CommentController::class, 'create']);
Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login')->middleware('guest'); // afficher la vue login
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest'); // input name = db
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::get('/register', [RegisterSessionController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisterSessionController::class, 'store'])->middleware('guest');
