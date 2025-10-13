<?php

use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\ContactListController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::resource('menus', MenuController::class);
Route::post('/menus-update-status', [MenuController::class, 'updateStatus'])->name('menus.updateStatus');
Route::resource('/contact-infos', ContactInfoController::class);

Route::get('/contact-lists', [ContactListController::class, 'index'])->name('contact-lists.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
