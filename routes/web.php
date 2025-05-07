<?php

use App\Http\Controllers\BarangayEmployeeController;
use App\Http\Controllers\BarangayPositionController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\FamilyRoleController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\HouseholdController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('residents.index', ['residents' => []]);    
});

//RESIDENTS WITH RESOURCE
Route::resource('residents', ResidentController::class);

//HOUSEHOLDS WITH RESOURCE
Route::resource('households', HouseholdController::class);

//FAMILYROLES WITH RESOURCE
Route::resource('familyroles', FamilyRoleController::class);

//BARANGAYPOSITION WITH RESOURCE
Route::resource('barangaypositions', BarangayPositionController::class);

//BARANGAYEMPLOYEE WITH RESOURCE
Route::resource('barangayemployees', BarangayEmployeeController::class);

//BUSINESS WITH RESOURCE
Route::resource('businesses', BusinessController::class);
