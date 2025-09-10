<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResidentController;
use App\Http\Controllers\Admin\ReportCategoryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReportStatusController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ReportController as UserReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/report', [UserReportController::class, 'index'])->name('report.index');
Route::get('/report/{code}', [UserReportController::class, 'show'])->name('report.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/take-report', [UserReportController::class, 'take'])->name('report.take');
    Route::get('/preview', [UserReportController::class, 'preview'])->name('report.preview');
    Route::get('/create-report', [UserReportController::class, 'create'])->name('report.create');
    Route::post('/create-report', [UserReportController::class, 'store'])->name('report.store');
    Route::get('/report-success', [UserReportController::class, 'success'])->name('report.success');

    Route::get('/my-report', [UserReportController::class, 'myReport'])->name('report.myreport');
    Route::get('/notifikasi', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password/edit', [ProfileController::class, 'editPassword'])->name('password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::get('/bantuan-dan-dukungan', [ProfileController::class, 'help'])->name('help.index');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google-callback', [LoginController::class, 'handleGoogleCallback'])->name('login.google.callback');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('admins', AdminController::class);
    Route::resource('/resident', ResidentController::class);
    Route::resource('/report-category', ReportCategoryController::class);
    Route::resource('/report', ReportController::class);
    Route::resource('/report-status', ReportStatusController::class)->except(['create']);
    Route::get('/report-status/{reportId}/create', [ReportStatusController::class, 'create'])->name('report-status.create');
});
