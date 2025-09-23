<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Api\ClientApiController;
use Illuminate\Http\Request;

Auth::routes();


Route::resource('clientes', ClientController::class)->middleware('auth');
Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->middleware('auth');
Route::get('/clientes/api/v1/auth-user', [ClientApiController::class, 'desktopLogin']);
Route::get('/clientes/api/v1/update-last-used', [ClientApiController::class, 'updateLastUsed']);