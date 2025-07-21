<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTypeFormController;
use App\Http\Controllers\Admin\TypeformWebhookController;



Route::get('/test', function () {
    return response()->json(['message' => 'It works!']);
});

//Webhooks
Route::post('/webhooks/typeform', [TypeformWebhookController::class, 'typeFormWebhooksHandle']);
Route::post('/webhooks/shopify-order-handle', [TypeformWebhookController::class, 'shopifyOrderWebhooksHandle']);
Route::post('/webhooks/shopify-customer-handle', [TypeformWebhookController::class, 'shopifyCustomerWebhooksHandle']);
Route::post('/webhooks/shopify-product-handle', [TypeformWebhookController::class, 'shopifyProductWebhooksHandle']);

