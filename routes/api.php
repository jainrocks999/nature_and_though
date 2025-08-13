<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTypeFormController;
use App\Http\Controllers\Api\WebhookController;



Route::get('/test', function () {
    return response()->json(['message' => 'It works!']);
});

//Webhooks
Route::post('/webhooks/typeform', [WebhookController::class, 'typeFormWebhooksHandle']);
Route::post('/webhooks/shopify-order-handle', [WebhookController::class, 'shopifyOrderWebhooksHandle']);
Route::post('/webhooks/shopify-customer-handle', [WebhookController::class, 'shopifyCustomerWebhooksHandle']);
Route::post('/webhooks/shopify-product-handle', [WebhookController::class, 'shopifyProductWebhooksHandle']);
Route::post('/webhooks/typeform-url-set', [WebhookController::class, 'setTypeFormUrl']);
