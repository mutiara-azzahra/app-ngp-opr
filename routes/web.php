<?php

use App\Http\Middleware\Auth;
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
    Route::get('/bendera/store', [BenderaController::class, 'store'])->name('bendera.store');
    Route::get('/bendera/update', [BenderaController::class, 'update'])->name('bendera.update');
    Route::get('/bendera/destroy', [BenderaController::class, 'destroy'])->name('bendera.destroy');
    Route::get('/bendera/checkbox', [BenderaController::class, 'checkbox'])->name('bendera.checkbox');
    Route::post('/bendera/print', [BenderaController::class, 'print'])->name('bendera.print');
    Route::get('/bendera/show', [BenderaController::class, 'show'])->name('bendera.show');
    Route::get('/bendera/edit', [BenderaController::class, 'edit'])->name('bendera.edit');

    //REFERENSI JENIS KAPAL
    Route::get('/jenis-kapal', [JenisKapalController::class, 'index'])->name('jenis-kapal.index');
    Route::get('/jenis-kapal/create', [JenisKapalController::class, 'create'])->name('jenis-kapal.create');
    Route::post('/jenis-kapal/store', [JenisKapalController::class, 'store'])->name('jenis-kapal.store');
    Route::post('/jenis-kapal/update', [JenisKapalController::class, 'update'])->name('jenis-kapal.update');
    Route::post('/jenis-kapal/destroy', [JenisKapalController::class, 'destroy'])->name('jenis-kapal.destroy');
    Route::get('/jenis-kapal/checkbox', [JenisKapalController::class, 'checkbox'])->name('jenis-kapal.checkbox');
    Route::post('/jenis-kapal/print', [JenisKapalController::class, 'print'])->name('jenis-kapal.print');

    //REFERENSI KAPAL
    Route::get('/kapal', [KapalController::class, 'index'])->name('kapal.index');
    Route::get('/kapal/create', [KapalController::class, 'create'])->name('kapal.create');
    Route::get('/kapal/show', [KapalController::class, 'show'])->name('kapal.show');
    Route::get('/kapal/edit', [KapalController::class, 'edit'])->name('kapal.edit');
    Route::post('/kapal/store', [KapalController::class, 'store'])->name('kapal.store');
    Route::get('/kapal/update', [KapalController::class, 'update'])->name('kapal.update');
    Route::get('/kapal/destroy', [KapalController::class, 'destroy'])->name('kapal.destroy');
    Route::get('/kapal/checkbox', [KapalController::class, 'checkbox'])->name('kapal.checkbox');
    Route::post('/kapal/print', [KapalController::class, 'print'])->name('kapal.print');

    //OWNERSHIP
    Route::get('/ownership', [OwnershipController::class, 'index'])->name('ownership.index');

    //CONTACT PERSON
    Route::get('/contact-person', [ContactPersonController::class, 'index'])->name('contact-person.index');

    //DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');

Route::get('/', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/', [LoginController::class, 'login'])->name('login');
