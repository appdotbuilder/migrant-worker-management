<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainingProgramController;
use App\Http\Controllers\FinancialTransactionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Member Management Routes
    Route::resource('members', MemberController::class);
    
    // Training Program Routes
    Route::resource('training-programs', TrainingProgramController::class);
    
    // Financial Transaction Routes
    Route::resource('financial-transactions', FinancialTransactionController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
