<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Api\ClientApiController;
use Illuminate\Http\Request;

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('clientes', ClientController::class)->middleware('auth');
Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->middleware('auth');
Route::get('/clientes/api/auth-user', [ClientApiController::class, 'desktopLogin']);
Route::get('/clientes/api/update-last-used', [ClientApiController::class, 'updateLastUsed']);