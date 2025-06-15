<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;


Auth::routes(["verify" => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');
Route::get('/', [GuestController::class, 'index']);
Route::get('/event/{slug}', [GuestController::class, 'showDetail'])->name('event_detail');
Route::get('tentang-kami', [GuestController::class, 'info'])->name('info');



Route::prefix('admin')->name('admin.')->group(function () {
    //Middleware Check
    Route::middleware(['auth', 'verified', 'user.role:admin'])->group(function () {
        Route::get('home', [AdminController::class, 'adminDashboard'])->name('home');
        
        // Events  
        Route::get('events', [AdminController::class, 'adminEvents'])->name('events_list');
        Route::get('events/tambah', [AdminController::class, 'tambah'])->name('tambah');
        Route::post('events', [AdminController::class, 'store'])->name('store');
        Route::put('admin/events/{event}', [AdminController::class, 'update'])->name('update');
        Route::get('admin/events/{event}/edit', [AdminController::class, 'edit'])->name('edit');
        Route::delete('admin/event/{id}', [AdminController::class, 'destroy'])->name('delete_event');

        // Bookings
        Route::get('events/{event}/pendaftaran', [AdminController::class, 'showPendaftaran'])->name('booking_list');
        Route::patch('bookings/{booking}/status', [AdminController::class, 'updateStatus'])->name('booking_updateStatus');
        Route::get('event/{slug}', [AdminController::class, 'showDetail'])->name('event_detail');
        Route::get('admin/all-bookings', [AdminController::class, 'semuaBooking'])->name('all_bookings');

        // Organizers
        Route::get('organizers/create', [AdminController::class, 'org_create'])->name('org_create');
        Route::post('organizers', [AdminController::class, 'org_store'])->name('org_store');
        Route::get('organizers', [AdminController::class, 'org_index'])->name('org_list');
        Route::get('organizers/{organizer}/edit', [AdminController::class, 'org_edit'])->name('org_edit');
        Route::put('organizers/{organizer}', [AdminController::class, 'org_update'])->name('org_update');
        Route::delete('organizers/{organizer}', [AdminController::class, 'org_destroy'])->name('org_delete');

    });

});

Route::prefix('user')->name('user.')->group(function () {

    //Middleware Check
    Route::middleware(['auth', 'verified', 'user.role:user'])->group(function () {
        Route::get('home', [UserController::class, 'home'])->name('home');
        Route::get('tentang-kami', [UserController::class, 'info'])->name('info');

        //bookmark & like
        Route::post('event/{event}/bookmark', [UserController::class, 'bookmark'])->name('bookmark');
        Route::post('event/{event}/like', [UserController::class, 'like'])->name('like');
        Route::get('bookmarked', [UserController::class, 'bookmarked'])->name('bookmarked');
        Route::get('liked', [UserController::class, 'liked'])->name('liked');
        
        //daftar_event
        Route::get('events', [UserController::class, 'userEvents'])->name('events_list');
        Route::get('event/{slug}', [UserController::class, 'showDetail'])->name('event_detail');
        Route::get('event/{event}/daftar', [UserController::class, 'showForm'])->name('daftar_event');
        Route::post('event/{event}/daftar', [UserController::class, 'store'])->name('booking_store');
        Route::get('riwayat-pendaftaran', [UserController::class, 'userBookings'])->name('booking_list');
        Route::get('riwayat-pendaftaran/{id}', [UserController::class, 'detailPendaftaran'])->name('detail_pendaftaran');

        
    });

});