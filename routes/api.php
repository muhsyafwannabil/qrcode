<?php
use App\Http\Controllers\AuthController;
use Illuminate\Routing\Route;
use App\Http\Controllers\QRCodeController;

Route::get('/qr-code', [QRCodeController::class, 'generate']);

Route::post('/register', [AuthController::class, 'register']);
Route::get('/user/{id}/qrcode', [AuthController::class, 'generateQRCode']);
