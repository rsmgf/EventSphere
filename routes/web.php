<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\OrganizerController;


Auth::routes(["verify" => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');
Route::get('/', [GuestController::class, 'index']);
Route::get('/event/{slug}', [GuestController::class, 'showDetail'])->name('event_detail');




Route::get('/detail', function () {
    return view('user.detail_event');
});


Route::prefix('admin')->name('admin.')->group(function () {
    //Middleware Check
    Route::middleware(['auth', 'verified', 'user.role:admin'])->group(function () {
        Route::get('home', [EventController::class, 'adminDashboard'])->name('home');
        Route::get('/proteksi-1', [HomeController::class, 'proteksi_1_admin'])->name('proteksi_1');
        
        // Events
        Route::get('events', [EventController::class, 'adminEvents'])->name('events_list');
        Route::get('/events/tambah', [EventController::class, 'tambah'])->name('tambah');
        Route::post('/events', [EventController::class, 'store'])->name('store');
        Route::get('/events/{event}/pendaftaran', [BookingController::class, 'showPendaftaran'])->name('pendaftaran');
        Route::patch('/bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('updateStatus');
        Route::get('/event/{slug}', [EventController::class, 'showDetail'])->name('event_detail');


        // Organizers
        Route::get('organizers/create', [OrganizerController::class, 'create'])->name('org_create');
        Route::post('organizers', [OrganizerController::class, 'store'])->name('org_store');
    });

});

Route::prefix('user')->name('user.')->group(function () {

    //Middleware Check
    Route::middleware(['auth', 'verified', 'user.role:user'])->group(function () {
        Route::get('home', [HomeController::class, 'userHome'])->name('home');
        Route::get('proteksi-1', [HomeController::class, 'proteksi_1_user'])->name('proteksi_1');
        Route::post('/events/{event}/register', [BookingController::class, 'store'])->name('register');
        Route::get('/event/{slug}', [HomeController::class, 'showDetail'])->name('event_detail');
        // Route::get('detail_event', [GuestController::class, 'detail_event'])->name('detail_event');
        // Route::get('daftar_event', [GuestController::class, 'daftar_event'])->name('daftar_event');
        // Route::post('proses_daftar_event', [GuestController::class, 'proses_daftar_event'])->name('proses_daftar_event');
        // Route::get('riwayat_pendaftaran', [GuestController::class, 'riwayat_pendaftaran'])->name('riwayat_pendaftaran');
        // Route::get('profile', [GuestController::class, 'profile'])->name('profile');
        // Route::post('edit_profile', [GuestController::class, 'edit_profile'])->name('edit_profile');
    });

});