<?php

use App\Http\Controllers\Admin\AdminAppointmentController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGoogleCalendarController;
use App\Http\Controllers\Admin\AdminPractitionerController;
use App\Http\Controllers\Admin\AdminScreenerController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PractitionerController;
use App\Http\Controllers\ScreenerController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// ==========================================
// LAMAN AWAM (PUBLIC CLINIC WEBSITE)
// ==========================================
Route::get('/', HomeController::class)->name('home');

// Tentang Kami & Hubungi
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/hubungi-kami', [PageController::class, 'contact'])->name('contact');

// Perkhidmatan
Route::get('/perkhidmatan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/perkhidmatan/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Pasukan Pakar
Route::get('/pasukan-pakar', [PractitionerController::class, 'index'])->name('practitioners.index');
Route::get('/pasukan-pakar/{slug}', [PractitionerController::class, 'show'])->name('practitioners.show');

// Hab Artikel & Psikoedukasi
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Ujian Saringan DASS-21
Route::get('/ujian-saringan', [ScreenerController::class, 'index'])->name('screener.index');
Route::post('/ujian-saringan', [ScreenerController::class, 'store'])->name('screener.store');
Route::get('/ujian-saringan/keputusan/{id}', [ScreenerController::class, 'result'])->name('screener.result');

// Enjin Tempahan Sesi
Route::get('/tempah-sesi', [BookingController::class, 'index'])->name('booking.index');
Route::get('/tempah-sesi/api/booked-slots', [BookingController::class, 'getBookedSlots'])->name('booking.booked-slots');
Route::post('/tempah-sesi', [BookingController::class, 'store'])->name('booking.store');
Route::get('/tempahan-berjaya/{booking_code}', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::post('/tempahan-berjaya/{booking_code}/muat-naik-resit', [BookingController::class, 'uploadReceipt'])->name('booking.upload-receipt');

// ==========================================
// PORTAL PENGURUSAN KLINIK (ADMIN PORTAL)
// ==========================================
Route::prefix('admin')->name('admin.')->group(function (): void {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Forgot Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

    // Protected Admin Routes
    Route::middleware('auth')->group(function (): void {
        Route::get('/', AdminDashboardController::class)->name('dashboard');

        // Pengurusan Tempahan
        Route::get('/tempahan', [AdminAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/tempahan/{id}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
        Route::patch('/tempahan/{id}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.update-status');

        // Google Calendar Appointments Sync
        Route::get('/google-calendar', [AdminGoogleCalendarController::class, 'index'])->name('google-calendar.index');
        Route::get('/google-calendar/{id}', [AdminGoogleCalendarController::class, 'show'])->name('google-calendar.show');
        Route::post('/google-calendar/sync', [AdminGoogleCalendarController::class, 'sync'])->name('google-calendar.sync');

        // Pengurusan Ujian Saringan
        Route::get('/ujian-saringan', [AdminScreenerController::class, 'index'])->name('screeners.index');
        Route::get('/ujian-saringan/{id}', [AdminScreenerController::class, 'show'])->name('screeners.show');

        // Pengurusan Perkhidmatan (CRUD)
        Route::resource('services', AdminServiceController::class)->except(['show']);

        // Pengurusan Pakar (CRUD)
        Route::resource('practitioners', AdminPractitionerController::class)->except(['show']);

        // Pengurusan Artikel (CRUD)
        Route::resource('articles', AdminArticleController::class)->except(['show']);
    });
});
