<?php

use App\Http\Middleware\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogActionController;
use App\Http\Controllers\LogCuserController;
use App\Http\Controllers\LogErrorController;
use App\Http\Controllers\LogEtcController;
use App\Http\Controllers\LogFormController;
use App\Http\Controllers\LogLoginController;
use App\Http\Controllers\LogMessageController;
use App\Http\Controllers\LogPrintController;
use App\Http\Controllers\LogReindexController;
use App\Http\Controllers\MasterPerusahaanController;
use App\Http\Controllers\KapalController;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/log/error', [LogErrorController::class, 'index'])->name('log.error');
    Route::get('/log/etc', [LogEtcController::class, 'index'])->name('log.etc');
    Route::get('/log/form', [LogFormController::class, 'index'])->name('log.form');
    Route::get('/log/message', [LogErrorController::class, 'index'])->name('log.message');
    Route::get('/log/print', [LogErrorController::class, 'index'])->name('log.print');
    Route::get('/log/reindex', [LogErrorController::class, 'index'])->name('log.reindex');

    //LOG ACTION
    Route::get('/log/action', [LogActionController::class, 'index'])->name('action.index');
    Route::post('/log/action/store', [LogActionController::class, 'store'])->name('action.store');
    Route::get('/log/action/{bulan}/{tahun}', [LogActionController::class, 'view'])->name('action.view');

    //LOG CUSER
    Route::get('/log/cuser', [LogCuserController::class, 'index'])->name('cuser.index');
    Route::post('/log/cuser/store', [LogCuserController::class, 'store'])->name('cuser.store');
    Route::get('/log/cuser/{bulan}/{tahun}', [LogCuserController::class, 'view'])->name('cuser.view');

    //LOG ERROR
    Route::get('/log/error', [LogErrorController::class, 'index'])->name('error.index');
    Route::post('/log/error/store', [LogErrorController::class, 'store'])->name('error.store');
    Route::get('/log/error/{bulan}/{tahun}', [LogErrorController::class, 'view'])->name('error.view');

    //LOG ETC
    Route::get('/log/etc', [LogEtcController::class, 'index'])->name('etc.index');
    Route::post('/log/etc/store', [LogEtcController::class, 'store'])->name('etc.store');
    Route::get('/log/etc/{bulan}/{tahun}', [LogEtcController::class, 'view'])->name('etc.view');

    //LOG FORM
    Route::get('/log/form', [LogFormController::class, 'index'])->name('form.index');
    Route::post('/log/form/store', [LogFormController::class, 'store'])->name('form.store');
    Route::get('/log/form/{bulan}/{tahun}', [LogFormController::class, 'view'])->name('form.view');

    //LOG LOGIN
    Route::get('/log/login', [LogLoginController::class, 'index'])->name('login.index');
    Route::post('/log/login/store', [LogLoginController::class, 'store'])->name('login.store');
    Route::get('/log/login/{bulan}/{tahun}', [LogLoginController::class, 'view'])->name('login.view');

    //LOG MESSAGE
    Route::get('/log/message', [LogMessageController::class, 'index'])->name('message.index');
    Route::post('/log/message/store', [LogMessageController::class, 'store'])->name('message.store');
    Route::get('/log/message/{bulan}/{tahun}', [LogMessageController::class, 'view'])->name('message.view');

    //LOG PRINT
    Route::get('/log/print', [LogPrintController::class, 'index'])->name('print.index');
    Route::post('/log/print/store', [LogPrintController::class, 'store'])->name('print.store');
    Route::get('/log/print/{bulan}/{tahun}', [LogPrintController::class, 'view'])->name('print.view');

    //LOG REINDEX
    Route::get('/log/reindex', [LogReindexController::class, 'index'])->name('reindex.index');
    Route::post('/log/reindex/store', [LogReindexController::class, 'store'])->name('reindex.store');
    Route::get('/log/reindex/{bulan}/{tahun}', [LogReindexController::class, 'view'])->name('reindex.view');

    //MASTER PERUSAHAAN
    Route::get('/master-perusahaan', [MasterPerusahaanController::class, 'index'])->name('master-perusahaan.index');

    //MASTER KAPAL
    Route::get('/kapal', [KapalController::class, 'index'])->name('kapal.index');
    Route::get('/kapal/create', [KapalController::class, 'create'])->name('kapal.create');
    Route::post('/kapal/store', [KapalController::class, 'store'])->name('kapal.store');
    Route::get('/kapal/edit/{id}', [KapalController::class, 'edit'])->name('kapal.edit');
    Route::post('/kapal/update', [KapalController::class, 'update'])->name('kapal.update');
    Route::post('/kapal/destroy', [KapalController::class, 'destroy'])->name('kapal.destroy');
    Route::get('/kapal/checkbox', [KapalController::class, 'checkbox'])->name('kapal.checkbox');

});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'formRegister'])->name('login.formRegister');

Route::get('/', [LoginController::class, 'formLogin'])->name('login.formLogin');
Route::post('/', [LoginController::class, 'login'])->name('login');
