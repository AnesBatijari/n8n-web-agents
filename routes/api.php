<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Callbacks\SeoAuditCallbackController;
use App\Http\Controllers\Callbacks\PotenzialCallbackController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/callbacks/seo-audit', [SeoAuditCallbackController::class, 'handle'])
    ->name('callbacks.seo_audit');

Route::post('/callbacks/potenzial', [PotenzialCallbackController::class, 'handle'])
    ->name('callbacks.potenzial');
