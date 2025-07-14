<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\TypeFormController;


Route::get('/', function () {
    return view('welcome');
})->middleware(['verify.shopify'])->name('home');


Route::get('/dashboard', [MasterController::class, 'dashboard'])->name('dashboard');
Route::get('/type-form-list', [TypeFormController::class, 'getTypeFormData'])->name('typeform.getTypeFormData');
Route::get('/clone-typeform-data', [TypeFormController::class, 'cloneTypeFormData'])->name('typeform.cloneTypeFormData');

Route::get('/type-form-response-list', [TypeFormController::class, 'getTypeFormResponse'])->name('typeform.getTypeFormResponse');

// Route::post('/typeform-store', [TypeFormController::class, 'store'])->name('typeform.store');




