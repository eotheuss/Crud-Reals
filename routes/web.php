<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(ProductController::class)->group(function(){
    Route::get('index')->name('index');
    Route::get('create','create')->name('create');
    Route::post('store')->name('store');
    Route::get({product}/edit','edit')->name('edit');
    Route::put({product}','update')->name('update');
    Route::delete({product}','destroy')->name('destroy');    
});