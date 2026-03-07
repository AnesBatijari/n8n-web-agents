<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Workflows\SeoAuditController;
use App\Http\Controllers\Workflows\PotenzialController;
use App\Http\Controllers\Callbacks\SeoAuditCallbackController;
use App\Http\Controllers\Callbacks\PotenzialCallbackController;
use App\Http\Controllers\WorkflowSettings\PotenzialSettingController;


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
    // SEO Audits UI
    Route::get('/seo-audits/create', [SeoAuditController::class, 'create'])->name('seo.create');
    Route::post('/seo-audits', [SeoAuditController::class, 'store'])->name('seo.store');
    Route::get('/seo-audits', [SeoAuditController::class, 'index'])->name('seo.index');

    // Potenzial UI
    Route::get('/potenzial/create', [PotenzialController::class, 'create'])->name('potenzial.create');
    Route::post('/potenzial', [PotenzialController::class, 'store'])->name('potenzial.store');
    Route::get('/potenzial', [PotenzialController::class, 'index'])->name('potenzial.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/potenzial/settings', [PotenzialSettingController::class, 'edit'])->name('potenzial.settings.edit');
    Route::put('/potenzial/settings', [PotenzialSettingController::class, 'update'])->name('potenzial.settings.update');
});

require __DIR__.'/auth.php';
