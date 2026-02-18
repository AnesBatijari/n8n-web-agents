<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/agent', [AgentController::class, 'index'])->name('agent.index');
    Route::post('/agent/send', [AgentController::class, 'send'])->name('agent.send');

    Route::get('/audits', [AgentController::class, 'audits'])->name('audits.index');
});

// keep this public (called by n8n)
Route::post('/agent/callback', [AgentController::class, 'callback'])->name('agent.callback');

require __DIR__.'/auth.php';
