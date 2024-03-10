<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FriendController;

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

Route::get('/', [PostController::class, 'index'])->middleware('auth');

Route::get('/login', function () {
    return view('login', ['title' => 'Login']);
})->middleware('guest')->name('login');

Route::get('/profile/{id}', [UserController::class, 'index'])->middleware('auth');

Route::get('/friends/{id}', [FriendController::class, 'index']);



Route::get('/addFriend/{receiverId}/{senderId}', [FriendController::class, 'addFriend']);

Route::get('/confirm/{id}', [FriendController::class, 'confirm']);

Route::get('/reject/{id}', [FriendController::class, 'reject']);

Route::get('/cancelRequest/{id}', [FriendController::class, 'cancelRequest']);

Route::get('/unfriend/{user1_id}/{user2_id}', [FriendController::class, 'unfriend']);



Route::post('/register', [UserController::class, 'store']);

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/xace', [PostController::class, 'store']);

Route::post('/photoProfile', [UserController::class, 'photoProfile']);