<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/submit-case', [CaseController::class, 'showForm']);
Route::post('/submit-case', [CaseController::class, 'submitCase']);
Route::get('/case/{id}', [CaseController::class, 'showCase']);

Route::get('/client/dashboard', [DashboardController::class, 'clientDashboard']);
Route::get('/lawyer/dashboard', [DashboardController::class, 'lawyerDashboard']);
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard']);
