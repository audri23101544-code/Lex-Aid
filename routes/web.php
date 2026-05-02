<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\FundingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HearingNoteController;




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
Route::get('/submit-case', [CaseController::class, 'create']);
Route::get('/admin/cases', [CaseController::class, 'adminCases']);
Route::post('/admin/cases/{id}/assign-lawyer', [CaseController::class, 'assignLawyer']);
Route::post('/register', [AuthController::class, 'register']);

use App\Http\Controllers\SosController;

// Client SOS
Route::get('/client/sos', [SosController::class, 'create']);
Route::post('/client/sos', [SosController::class, 'store']);

Route::get('/forum', [ForumController::class, 'index']);
Route::post('/forum/post', [ForumController::class, 'store']);
Route::post('/forum/reply/{questionId}', [ForumController::class, 'reply']);

use App\Http\Controllers\EvidenceController;

Route::get('/client/evidence', [EvidenceController::class, 'index']);
Route::post('/client/evidence/upload', [EvidenceController::class, 'upload']);
Route::get('/lawyer/evidence', [EvidenceController::class, 'lawyerIndex']);

// Admin SOS
Route::get('/admin/sos', [SosController::class, 'adminIndex']);
Route::post('/admin/sos/update/{id}', [SosController::class, 'updateStatus']);
Route::get('/admin/performance', [PerformanceController::class, 'index']);
Route::post('/sos/update/{id}', [SosController::class, 'updateStatus']);
Route::get('/admin/funding', [FundingController::class, 'index']);
Route::post('/admin/funding/source', [FundingController::class, 'storeSource']);
Route::post('/admin/funding/allocate', [FundingController::class, 'allocate']);
Route::get('/admin/notifications', [NotificationController::class, 'index']);
Route::post('/admin/notifications/send', [NotificationController::class, 'send']);
// Appointment Booking & Scheduling
Route::get('/client/appointments', [AppointmentController::class, 'clientCreate']);
Route::post('/client/appointments', [AppointmentController::class, 'clientStore']);

Route::get('/lawyer/appointments', [AppointmentController::class, 'lawyerIndex']);
Route::post('/lawyer/appointments/update/{id}', [AppointmentController::class, 'updateStatus']);

// Hearing Notes sos
Route::get('/lawyer/hearing-notes', [HearingNoteController::class, 'index']);
Route::post('/lawyer/hearing-notes/store', [HearingNoteController::class, 'store']);

// Case Priority Scoring System
Route::get('/admin/priority', [PriorityController::class, 'index']);
Route::post('/admin/priority/update/{id}', [PriorityController::class, 'updateOne']);
Route::post('/admin/priority/update-all', [PriorityController::class, 'updateAll']);