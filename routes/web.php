<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return "DB connected: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "DB failed: " . $e->getMessage();
    }
});

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/admin', [AuthController::class, 'adminDashboard']);

Route::get('/lawyer', function () {
    return "Lawyer Dashboard";
});

Route::get('/client', function () {
    return "Client Dashboard";
});


use App\Http\Controllers\CaseController;

Route::get('/case/create', [CaseController::class, 'create']);
Route::post('/case/store', [CaseController::class, 'store']);
Route::get('/cases', [CaseController::class, 'index']);