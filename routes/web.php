<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BenderaController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\JenisKapalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnershipController;
use App\Http\Controllers\ContactPersonController;

Route::middleware('auth')->group(function () {
    //REFERENSI BENDERA
    Route::get('/bendera', [BenderaController::class, 'index'])->name('bendera.index');
    Route::get('/bendera/create', [BenderaController::class, 'create'])->name('bendera.create');
    Route::post('/bendera/update', [BenderaController::class, 'update'])->name('bendera.update');
    Route::get('/bendera/destroy', [BenderaController::class, 'destroy'])->name('bendera.destroy');
    Route::get('/bendera/checkbox', [BenderaController::class, 'checkbox'])->name('bendera.checkbox');
    Route::post('/bendera/print', [BenderaController::class, 'print'])->name('bendera.print');

    Route::middleware('ajax')->group(function () {
        Route::get('/bendera/show', [BenderaController::class, 'show'])->name('bendera.show');
        Route::get('/bendera/edit', [BenderaController::class, 'edit'])->name('bendera.edit');
        Route::post('/bendera/store', [BenderaController::class, 'store'])->name('bendera.store');
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');
Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

Route::get('/', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/', [LoginController::class, 'login'])->name('login');
