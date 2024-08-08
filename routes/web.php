<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(ProductController::class)->group(function(){
    Route::get('index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store')->name('store');
    Route::get('edit')->name('edit');
    Route::put('update')->name('update');
    Route::delete('destroy')->name('destroy');    
});