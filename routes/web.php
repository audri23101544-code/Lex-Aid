<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\FundingController;
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

Route::get('/lawyer', [AuthController::class, 'lawyerDashboard']);
#Route::get('/client', [AuthController::class, 'clientDashboard']);
Route::get('/client', [AuthController::class, 'clientDashboard']);
Route::get('/register', function () {
    return view('register');
});
use App\Http\Controllers\CaseController;

Route::get('/case/create', [CaseController::class, 'create']);
Route::post('/case/store', [CaseController::class, 'store']);
Route::get('/cases', [CaseController::class, 'index']);

Route::post('/register', [AuthController::class, 'register']);

use App\Http\Controllers\SosController;

// Client SOS
Route::get('/client/sos', [SosController::class, 'create']);
Route::post('/client/sos', [SosController::class, 'store']);

// Admin SOS
Route::get('/admin/sos', [SosController::class, 'adminIndex']);
Route::post('/admin/sos/update/{id}', [SosController::class, 'updateStatus']);
Route::get('/admin/performance', [PerformanceController::class, 'index']);
Route::post('/sos/update/{id}', [SosController::class, 'updateStatus']);
Route::get('/admin/funding', [FundingController::class, 'index']);
Route::post('/admin/funding/source', [FundingController::class, 'storeSource']);
Route::post('/admin/funding/allocate', [FundingController::class, 'allocate']);