<?php

use App\Http\Controllers\Api\V1\Admin\ContactInfoApiController;
use App\Http\Controllers\Api\V1\Admin\ContactListAPIController;
use App\Http\Controllers\Api\V1\Admin\MenuApiController;
use App\Http\Controllers\Api\V1\Admin\SettingsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::apiResource('contact-info', ContactInfoApiController::class);
    Route::apiResource('contact-lists', ContactListAPIController::class);
    Route::apiResource('settings', SettingsApiController::class);
    Route::get('active-menus', [MenuApiController::class, 'activeMenus']);
    Route::apiResource('menus', MenuApiController::class);
});
