<?php

use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BenderaController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    //REFERENSI BENDERA
    Route::get('/bendera', [BenderaController::class, 'index'])->name('bendera.index');
    Route::get('/bendera/create', [BenderaController::class, 'create'])->name('bendera.create');
    Route::post('/bendera/store', [BenderaController::class, 'store'])->name('bendera.store');
    Route::get('/bendera/edit/{id}', [BenderaController::class, 'edit'])->name('bendera.edit');
    Route::post('/bendera/update/{id}', [BenderaController::class, 'update'])->name('bendera.update');
    Route::post('/bendera/destroy', [BenderaController::class, 'destroy'])->name('bendera.destroy');
    Route::get('/bendera/checkbox', [BenderaController::class, 'checkbox'])->name('bendera.checkbox');
    Route::post('/bendera/print', [BenderaController::class, 'print'])->name('bendera.print');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');

Route::get('/', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/', [LoginController::class, 'login'])->name('login');
