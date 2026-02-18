<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Callbacks\SeoAuditCallbackController;
use App\Http\Controllers\Callbacks\PotenzialCallbackController;

Route::post('/callbacks/seo-audit', [SeoAuditCallbackController::class, 'handle'])
    ->name('callbacks.seo_audit');

Route::post('/callbacks/potenzial', [PotenzialCallbackController::class, 'handle'])
    ->name('callbacks.potenzial');
