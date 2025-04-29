<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\HouseholdController;

Route::get('/', function () {
    return view('welcome');
});

//RESIDENTS WITH RESOURCE
Route::resource('residents', ResidentController::class);

//HOUSEHOLDS WITH RESOURCE
Route::resource('households', HouseholdController::class);
