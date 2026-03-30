<?php

use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\QiscusIntegrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('webhook')->group(function () {
    Route::post('/leads', [WebhookController::class, 'ingestLead']);
    Route::post('/chats', [WebhookController::class, 'ingestChat']);
    Route::post('/decisions', [WebhookController::class, 'ingestDecision']);
});

Route::prefix('integrations/qiscus')->group(function () {
    Route::post('/resolve', [QiscusIntegrationController::class, 'resolve']);
    Route::post('/flags', [QiscusIntegrationController::class, 'flags']);
});

Route::get('/personas/{id}', [PersonaController::class, 'show']);
Route::post('/personas/{id}/knowledge', [PersonaController::class, 'storeKnowledgeBatch']);
