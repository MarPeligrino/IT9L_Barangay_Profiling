<?php

use App\Http\Controllers\BarangayCertificateController;
use App\Http\Controllers\BarangayEmployeeController;
use App\Http\Controllers\BarangayPositionController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessPermitController;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\CertificateTypeController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FamilyRoleController;
use App\Http\Controllers\IncidentReportController;
use App\Http\Controllers\PermitTransactionsController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Root route: Redirect based on auth status
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    // Login routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register routes
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // Forgot Password routes
    Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [UserController::class, 'sendResetLinkEmail'])->name('password.email');

    // Password Reset routes
    Route::get('/reset-password/{token}', [UserController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Profile and Settings routes
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/settings', [UserController::class, 'updateSettings'])->name('settings.update');
});

//RESIDENTS WITH RESOURCE
Route::resource('residents', ResidentController::class);

//ADDRESS WITH RESOURCE
Route::resource('addresses', AddressController::class);

//FAMILYROLES WITH RESOURCE
Route::resource('familyroles', FamilyRoleController::class);

//BARANGAYPOSITION WITH RESOURCE
Route::resource('barangaypositions', BarangayPositionController::class);

//BARANGAYEMPLOYEE WITH RESOURCE
Route::resource('barangayemployees', BarangayEmployeeController::class);

//BUSINESS WITH RESOURCE
Route::resource('businesses', BusinessController::class);

//BUSINESSTYPE WITH RESOURCE
Route::resource('businessTypes', BusinessTypeController::class);

//BUSINESSPERMIT WITH RESOURCE
Route::resource('businessPermits', BusinessPermitController::class);

//BUSINESSPERMIT WITH RESOURCE
Route::resource('permitTransactions', PermitTransactionsController::class);

// DASHBOARD
Route::get('/', [DashboardController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//CERTIFICATE TYPES WITH RESOURCE
Route::resource('certificateTypes', CertificateTypeController::class);

//CERTIFICATE TYPES WITH RESOURCE
Route::resource('barangayCertificates', BarangayCertificateController::class);

//INCIDENT REPORT WITH RESOURCE
Route::resource('incidentReports', IncidentReportController::class);

//INCIDENT REPORT WITH RESOURCE
Route::resource('complaints', ComplaintController::class);