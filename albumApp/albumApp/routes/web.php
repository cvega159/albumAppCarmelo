<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ResourceControllerFruit;


/*Route::get('/', function () {
    return view('base');
});*/

Route::get('/', [IndexController::class,'about'])-> name('index');
Route::get('about', [IndexController::class,'about'])-> name('about');
Route::resource('resource', ResourceController::class);//me carga los 7 metodos