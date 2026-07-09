<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Http\Controllers\TesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\UjianController;

// Definisikan rate limiter
RateLimiter::for('login', function (Request $request) {
    return Limit::perMinute(5)->by($request->ip());
});

RateLimiter::for('tes', function (Request $request) {
    return Limit::perMinute(1)->by($request->ip());
});

// Routes for Kandidat (Public)
Route::get('/', [KandidatController::class, 'welcome']);
Route::get('/login-kandidat', [KandidatController::class, 'showLogin'])->name('kandidat.login');
Route::post('/login-kandidat', [KandidatController::class, 'login'])->middleware('throttle:login');
Route::get('/logout-kandidat', [KandidatController::class, 'logout']);

// Routes for Admin Authentication (Guest)
Route::get('/admin/login', [AdminController::class, 'login'])->name('login');
Route::post('/admin/login', [AdminController::class, 'loginPost'])->middleware('throttle:login');

// Protected Candidate Routes
Route::middleware(['auth:kandidat'])->group(function () {
    Route::get('/instruksi', [KandidatController::class, 'instruksi']);
    Route::post('/tes/mulai', [UjianController::class, 'mulaiTesPribadi']);
    Route::get('/tes', [TesController::class, 'showForm']);
    Route::post('/tes/submit', [TesController::class, 'submit'])->middleware('throttle:tes');
    Route::get('/tes/selesai', function () {
        return view('tes.selesai');
    });
    Route::get('/tes/hasil/{id}', [TesController::class, 'hasil'])->name('tes.hasil');
});

// Protected Admin Routes
Route::middleware(['auth:web'])->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout']);
    Route::post('/admin/ujian/status', [UjianController::class, 'updateGlobalStatus']);
    Route::get('/admin/ujian/sisa-waktu', [UjianController::class, 'getSisaWaktu']); 
    Route::get('/admin', [AdminController::class, 'index']);
    
    // SPESIFIK dulu (tanpa wildcard)
    Route::get('/admin/kandidat', [AdminController::class, 'kandidatIndex']);
    Route::get('/admin/kandidat/create', [AdminController::class, 'kandidatCreate']);
    Route::post('/admin/kandidat', [AdminController::class, 'kandidatStore']);
    Route::post('/admin/kandidat/import', [AdminController::class, 'kandidatImport']);
    Route::get('/admin/kandidat/import-history', [AdminController::class, 'showAllImportHistory']);
    Route::delete('/admin/kandidat/{id}', [AdminController::class, 'kandidatDelete']);
    
    // WILDCARD belakangan
    Route::get('/admin/{id}', [AdminController::class, 'show']);
    Route::delete('/admin/{id}', [AdminController::class, 'destroy']);
});
