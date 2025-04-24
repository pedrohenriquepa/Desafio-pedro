<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('web', 'auth')->group(function () {
    Route::get('/desafio-avelar', [Controller::class, 'index'])->name('desafio.avelar.index');
});
