<?php

use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\ClubTagController;
use App\Http\Controllers\Admin\CommitteeController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\ContactListController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\EventTagController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\BoardMemberController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::resource('/menus', MenuController::class);
    Route::post('/menus-update-status', [MenuController::class, 'updateStatus'])->name('menus.updateStatus');
    Route::resource('/contact-infos', ContactInfoController::class);
    Route::resource('/event-tags', EventTagController::class);
    Route::resource('/events', EventController::class);
    Route::post('/events/upload-image', [EventController::class, 'upload'])->name('events.upload');

    Route::resource('/club-tags', ClubTagController::class);
    Route::resource('/clubs', ClubController::class);
    Route::resource('/committees', CommitteeController::class);

    Route::get('/contact-lists', [ContactListController::class, 'index'])->name('contact-lists.index');

    Route::get('/settings-index', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings-update', [SettingsController::class, 'update'])->name('settings.update');

    Route::get('/profile-index', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile-checkOldPassword', [ProfileController::class, 'checkOldPassword'])->name('profile.checkOldPassword');
    Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/contact-lists/{id}/mark-seen', [ContactListController::class, 'markSeen'])->name('contact-lists.mark-seen');

    Route::get('about', [AboutUsController::class, 'index'])->name('about.index');
    Route::get('about/create', [AboutUsController::class, 'create'])->name('about.create');
    Route::post('about', [AboutUsController::class, 'store'])->name('about.store');
    Route::get('about/{about}/edit', [AboutUsController::class, 'edit'])->name('about.edit');
    Route::put('about/{about}', [AboutUsController::class, 'update'])->name('about.update');
    Route::delete('about/{about}', [AboutUsController::class, 'destroy'])->name('about.destroy');

    // ---------------- Board Members ----------------
    Route::get('board-members', [BoardMemberController::class, 'index'])->name('board.index');
    Route::get('board-members/create', [BoardMemberController::class, 'create'])->name('board.create');
    Route::post('board-members', [BoardMemberController::class, 'store'])->name('board.store');
    Route::get('board-members/{boardMember}/edit', [BoardMemberController::class, 'edit'])->name('board.edit');
    Route::put('board-members/{boardMember}', [BoardMemberController::class, 'update'])->name('board.update');
    Route::delete('board-members/{boardMember}', [BoardMemberController::class, 'destroy'])->name('board.destroy');

    // ---------------- Gallery ----------------
    Route::get('galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

    Route::get('/socials', [App\Http\Controllers\Admin\SocialController::class, 'index'])->name('socials.index');
    Route::post('/socials/update', [App\Http\Controllers\Admin\SocialController::class, 'update'])->name('socials.update');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
