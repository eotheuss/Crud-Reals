<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/cidades/{estado}', [UserController::class, 'getCidades']);
Route::resource('users', UserController::class);
Route::get('/users', [UserController::class, 'read'])->name('users.read');
