<?php

use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ChatLogController;
use App\Http\Controllers\DecisionInboxController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('google.callback');

Route::post('/logout', [GoogleLoginController::class, 'logout'])
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('personas', PersonaController::class);
    Route::post('personas/{persona}/knowledge', [PersonaController::class, 'storeKnowledge'])->name('personas.knowledge.store');
    Route::delete('personas/{persona}/knowledge/{knowledge}', [PersonaController::class, 'destroyKnowledge'])->name('personas.knowledge.destroy');
    
    // New Module Routes
    Route::get('/whatsapp', [WhatsappController::class, 'index'])->name('whatsapp.index');
    Route::post('/whatsapp', [WhatsappController::class, 'store'])->name('whatsapp.store');
    Route::delete('/whatsapp/{whatsappAccount}', [WhatsappController::class, 'destroy'])->name('whatsapp.destroy');
    Route::get('/leads/export', [LeadController::class, 'export'])->name('leads.export');
    Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
    Route::get('/chat-logs', [ChatLogController::class, 'index'])->name('chats.index');
    Route::get('/chat-logs/{lead}', [ChatLogController::class, 'show'])->name('chats.show');
    Route::get('/decision-inbox/export', [DecisionInboxController::class, 'export'])->name('decision-inbox.export');
    Route::get('/decision-inbox', [DecisionInboxController::class, 'index'])->name('decision-inbox.index');
    Route::patch('/decision-inbox/{decision}', [DecisionInboxController::class, 'update'])->name('decision-inbox.update');
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::put('/account', [AccountController::class, 'update'])->name('account.update');
});
