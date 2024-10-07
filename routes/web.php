<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BenderaController;
use App\Http\Controllers\KapalController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')->group(function () {
    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //MASTER KAPAL
    Route::get('/kapal', [KapalController::class, 'index'])->name('kapal.index');
    Route::get('/kapal/create', [KapalController::class, 'create'])->name('kapal.create');
    Route::get('/kapal/show', [KapalController::class, 'show'])->name('kapal.show');
    Route::get('/kapal/edit/{id}', [KapalController::class, 'edit'])->name('kapal.edit');
    Route::post('/kapal/store', [KapalController::class, 'store'])->name('kapal.store');
    Route::post('/kapal/update', [KapalController::class, 'update'])->name('kapal.update')->middleware('ajax');
    Route::delete('/kapal/destroy', [KapalController::class, 'destroy'])->name('kapal.destroy')->middleware('ajax');
    Route::get('/kapal/print', [KapalController::class, 'print'])->name('kapal.print')->middleware('ajax');

    //MASTER DATA BENDERA
    Route::get('/bendera', [BenderaController::class, 'index'])->name('bendera.index');
    Route::get('/bendera/create', [BenderaController::class, 'create'])->name('bendera.create');
    Route::get('/bendera/destroy', [BenderaController::class, 'destroy'])->name('bendera.destroy');
    Route::get('/bendera/checkbox', [BenderaController::class, 'checkbox'])->name('bendera.checkbox');
    Route::post('/bendera/store', [BenderaController::class, 'store'])->name('bendera.store');
    Route::post('/bendera/update', [BenderaController::class, 'update'])->name('bendera.update');
    Route::post('/bendera/print', [BenderaController::class, 'print'])->name('bendera.print');

    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/bendera/show', [BenderaController::class, 'show'])->name('bendera.show');
    Route::get('/bendera/edit', [BenderaController::class, 'edit'])->name('bendera.edit');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');

Route::get('/', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/', [LoginController::class, 'login'])->name('login');
