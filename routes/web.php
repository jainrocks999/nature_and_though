<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\TypeFormController;
use App\Http\Controllers\Admin\SurveyConfigController;


Route::get('/', function () {
    return view('welcome');
})->middleware(['verify.shopify'])->name('home');


Route::get('/dashboard', [MasterController::class, 'dashboard'])->name('dashboard');
Route::get('/type-form-list', [TypeFormController::class, 'getTypeFormData'])->name('typeform.getTypeFormData');
Route::get('/clone-typeform-data', [TypeFormController::class, 'cloneTypeFormData'])->name('typeform.cloneTypeFormData');

Route::get('/clone-all-typeform-response', [TypeFormController::class, 'cloneAllTypeFormResponse'])->name('typeform.cloneAllTypeFormResponse');
Route::get('/type-form-response-list', [TypeFormController::class, 'getTypeFormResponse'])->name('typeform.getTypeFormResponse');


//Survey Config
Route::get('/survey-config-list', [SurveyConfigController::class, 'getSurveyConfig'])->name('surveyConfig.getSurveyConfig');
Route::get('/survey-config-create', [SurveyConfigController::class, 'createSurveyConfig'])->name('surveyConfig.createSurveyConfig');
Route::post('/survey-config-store', [SurveyConfigController::class, 'storeSurveyConfig'])->name('surveyConfig.storeSurveyConfig');
Route::get('/survey-config-edit', [SurveyConfigController::class, 'editSurveyConfig'])->name('surveyConfig.editSurveyConfig');
Route::post('/survey-config-update', [SurveyConfigController::class, 'updateSurveyConfig'])->name('surveyConfig.updateSurveyConfig');
Route::get('/survey-config-delete/{id}', [SurveyConfigController::class, 'deleteSurveyConfig'])->name('surveyConfig.deleteSurveyConfig');







