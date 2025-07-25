<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ApiClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageLogController;
use App\Http\Controllers\WhatsappLoginController;

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/status', [DashboardController::class, 'status'])->name('dashboard.status');

    // WhatsApp Message
    Route::get('/whatsapp/send-message', [MessageController::class, 'index'])->name('whatsapp.message');
    Route::post('/whatsapp/send-message', [MessageController::class, 'send'])->name('message.send');

    // WhatsApp Session/Login
    Route::prefix('whatsapp')->group(function () {
        Route::get('/login', [WhatsappLoginController::class, 'index'])->name('whatsapp.login');
        Route::post('/start', [WhatsappLoginController::class, 'start'])->name('whatsapp.start');
        Route::get('/status', [WhatsappLoginController::class, 'status'])->name('whatsapp.status');
        Route::get('/qr-image', [WhatsappLoginController::class, 'getQrImage'])->name('whatsapp.qr-image');
        Route::post('/logout', [WhatsappLoginController::class, 'logout'])->name('whatsapp.logout');
    });

    // History & Report
    Route::get('/user', [HistoryController::class, 'user'])->name('user');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/history/export', [HistoryController::class, 'export'])->name('history.export');
    Route::get('/report', [ReportController::class, 'index'])->name('report');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/save', [SettingsController::class, 'save']);
    Route::post('/settings/reset', [SettingsController::class, 'reset'])->name('settings.reset');

    Route::get('/check-update', [UpdateController::class, 'check'])->name('update.check');
    Route::post('/install-update', [UpdateController::class, 'install'])->name('update.install');

    // User Profile
    Route::resource('profile', UserController::class)->only(['edit', 'update']);

    // API Clients
    Route::resource('clients', ApiClientController::class)->except('show');
    Route::patch('/clients/{client}/toggle', [ApiClientController::class, 'toggle'])->name('clients.toggle');
    Route::patch('/clients/{client}/regenerate', [ApiClientController::class, 'regenerate'])->name('clients.regenerate');

    // Logs
    Route::get('/logs', [MessageLogController::class, 'index'])->name('logs.index');
    Route::get('/logs/export', [MessageLogController::class, 'export'])->name('logs.export');

    // Help Pages
    Route::prefix('help')->name('help.')->group(function () {
        Route::get('/', [HelpController::class, 'index'])->name('index');
        Route::get('/api', [HelpController::class, 'api'])->name('api');
    });
});

// Auth routes
require __DIR__.'/auth.php';
