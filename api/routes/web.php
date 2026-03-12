<?php

use App\Http\Controllers\FrontEndController\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
