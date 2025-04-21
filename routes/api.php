<?php
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

Route::post('/', [SesiController::class, 'login']);
