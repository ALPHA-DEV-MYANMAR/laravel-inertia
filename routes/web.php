<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;

//Route::get('/',[PageController::class,'index'])->name('index');
//Route::delete('/user/{id}',[PageController::class,'destory'])->name('destory');

Route::resource('user',\App\Http\Controllers\UserController::class);

Route::inertia('/','index');
