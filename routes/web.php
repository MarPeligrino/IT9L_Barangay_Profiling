<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;

Route::get('/', function () {
    return view('welcome');
});

//RESIDENTS WITH RESOURCE
Route::resource('residents', ResidentController::class);
