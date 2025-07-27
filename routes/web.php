<?php

use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ! Chat
Route::get('/', [ChatController::class, 'index'])->name('chat')->middleware('auth');
Route::get('{username}/chat/', [ChatController::class, 'chatting'])->name('chatting')->middleware('auth');
// ! Request
Route::get('/request', [RequestController::class, 'request'])->name('request')->middleware('auth');
Route::get('/request/{username}', [RequestController::class, 'profileView'])->name('profile.view')->middleware('auth');
Route::get('/search', [RequestController::class, 'search'])->name('search')->middleware('auth');
// ! Register
Route::get('/register', [ViewController::class, 'register'])->name('registerPage')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
// ! Login
Route::get('/login', [ViewController::class, 'login'])->name('loginPage')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
// ! CheckUsername
Route::post('/check-username', [AuthController::class, 'checkUsername'])->name('check.userna`me');
// ! Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
// ! Profile
Route::get('/profile', [ChatController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/set-default-picture', [ProfileController::class, 'setDefaultPicture'])->name('setdefaultPicture')->middleware('auth');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
// ! Friend
Route::post('/friend/accept/{id}', [RequestController::class, 'accept'])->name('friend.accept')->middleware('auth');
Route::post('/friend/decline/{id}', [RequestController::class, 'decline'])->name('friend.decline')->middleware('auth');

Route::get('/{username}', [ProfileController::class, 'profileShow'])->name('profile.show')->middleware('auth');
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

// Existing routes...

// Existing routes...

// Existing routes...

// Friend request routes
Route::post('/friend/request/{username}', [RequestController::class, 'sendRequest'])->name('friend.request')->middleware('auth');
Route::delete('/friend/remove/{id}', [RequestController::class, 'removeFriend'])->name('friend.remove')->middleware('auth');