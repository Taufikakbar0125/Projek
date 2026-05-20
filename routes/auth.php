<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', [LoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'doLogin'])->name('admin.login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
