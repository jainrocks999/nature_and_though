<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTypeFormController;
use App\Http\Controllers\Admin\TypeformWebhookController;



Route::get('/test', function () {
    return response()->json(['message' => 'It works!']);
});

Route::post('/webhooks/typeform', [TypeformWebhookController::class, 'webhooksHandle']);
