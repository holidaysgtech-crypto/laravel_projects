<?php

use App\Http\Controllers\Api\QRCodeController;
use Illuminate\Support\Facades\Route;

Route::prefix('qr')->group(function () {

    // GET /api/qr/dashboard
    Route::get('/dashboard', [QRCodeController::class, 'dashboard']);

    // POST /api/qr/preview
    Route::post('/preview', [QRCodeController::class, 'preview']);

    // POST /api/qr/store
    Route::post('/store', [QRCodeController::class, 'store']);

    // GET /api/qr/history
    Route::get('/history', [QRCodeController::class, 'history']);

    // GET /api/qr/download/{qrCode}
    Route::get('/download/{qrCode}', [QRCodeController::class, 'download']);

    // DELETE /api/qr/destroy/{qrCode}
    Route::delete('/destroy/{qrCode}', [QRCodeController::class, 'destroy']);

});