<?php

use App\Http\Controllers\AdminScheduleController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/admin/login', [AdminScheduleController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminScheduleController::class, 'login'])->name('admin.login.store');
Route::get('/login', [AdminScheduleController::class, 'create'])->name('login');
Route::post('/login', [AdminScheduleController::class, 'login'])->name('login.store');
Route::middleware('auth')->prefix('admin')->group(function (): void {
    Route::get('/jadwal', [AdminScheduleController::class, 'index'])->name('admin.schedule');
    Route::put('/jadwal', [AdminScheduleController::class, 'update'])->name('admin.schedule.update');
    Route::post('/logout', [AdminScheduleController::class, 'logout'])->name('admin.logout');
});
