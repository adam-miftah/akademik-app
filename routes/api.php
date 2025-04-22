<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::middleware('role:dosen')->get('/dosen/dashboard', [DosenController::class, 'dashboard']);
    Route::middleware('role:mahasiswa')->get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard']);
});
// Public routes
Route::post('/login', [AuthController::class, 'login']);
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn (Request $request) => $request->user());
    Route::post('/logout', [AuthController::class, 'logout']);
});
