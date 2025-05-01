<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvelarController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('avelar', AvelarController::class);


