<?php

use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\ClubTagController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\ContactListController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EventTagController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::resource('menus', MenuController::class);
Route::post('/menus-update-status', [MenuController::class, 'updateStatus'])->name('menus.updateStatus');
Route::resource('/contact-infos', ContactInfoController::class);
Route::resource('/event-tags', EventTagController::class);
Route::resource('/events', EventController::class);
Route::post('/events/upload-image', [EventController::class, 'upload'])->name('events.upload');

Route::resource('/club-tags', ClubTagController::class);
Route::resource('/clubs', ClubController::class);

Route::get('/contact-lists', [ContactListController::class, 'index'])->name('contact-lists.index');

Route::get('/settings-index', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings-update', [SettingsController::class, 'update'])->name('settings.update');

Route::get('/profile-index', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile-checkOldPassword', [ProfileController::class, 'checkOldPassword'])->name('profile.checkOldPassword');
Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
