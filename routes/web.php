<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\AnggotaLembagaController;
use App\Http\Controllers\JabatanLembagaController;

// Public Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect ke login
Route::get('/', function () {
    return redirect('/login');
});

// Protected Routes
Route::middleware(['checkLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY (FULL AKSES)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        // USER MANAGEMENT (Hanya admin)
        Route::prefix('user')->name('admin.user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN + OPERATOR (Banyak Tugas)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,operator'])->group(function () {
        // WARGA (Full CRUD)
        Route::prefix('warga')->name('admin.warga.')->group(function () {
            Route::get('/', [WargaController::class, 'index'])->name('index');
            Route::get('/create', [WargaController::class, 'create'])->name('create');
            Route::post('/', [WargaController::class, 'store'])->name('store');
            Route::get('/{warga}', [WargaController::class, 'show'])->name('show');
            Route::get('/{warga}/edit', [WargaController::class, 'edit'])->name('edit');
            Route::put('/{warga}', [WargaController::class, 'update'])->name('update');
            Route::delete('/{warga}', [WargaController::class, 'destroy'])->name('destroy');
        });

        // PERANGKAT DESA (Full CRUD)
        Route::prefix('perangkat-desa')->name('admin.perangkat_desa.')->group(function () {
            Route::get('/', [PerangkatDesaController::class, 'index'])->name('index');
            Route::get('/create', [PerangkatDesaController::class, 'create'])->name('create');
            Route::post('/', [PerangkatDesaController::class, 'store'])->name('store');
            Route::get('/{perangkatDesa}', [PerangkatDesaController::class, 'show'])->name('show');
            Route::get('/{perangkatDesa}/edit', [PerangkatDesaController::class, 'edit'])->name('edit');
            Route::put('/{perangkatDesa}', [PerangkatDesaController::class, 'update'])->name('update');
            Route::delete('/{perangkatDesa}', [PerangkatDesaController::class, 'destroy'])->name('destroy');
        });

        // WILAYAH - RW (Full CRUD)
        Route::prefix('rw')->name('admin.rw.')->group(function () {
            Route::get('/', [RwController::class, 'index'])->name('index');
            Route::get('/create', [RwController::class, 'create'])->name('create');
            Route::post('/', [RwController::class, 'store'])->name('store');
            Route::get('/{id}', [RwController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [RwController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RwController::class, 'update'])->name('update');
            Route::delete('/{id}', [RwController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/set-ketua', [RwController::class, 'setKetua'])->name('set_ketua');
        });

        // WILAYAH - RT (Full CRUD)
        Route::prefix('rt')->name('admin.rt.')->group(function () {
            Route::get('/', [RtController::class, 'index'])->name('index');
            Route::get('/create', [RtController::class, 'create'])->name('create');
            Route::post('/', [RtController::class, 'store'])->name('store');
            Route::get('/{id}', [RtController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [RtController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RtController::class, 'update'])->name('update');
            Route::delete('/{id}', [RtController::class, 'destroy'])->name('destroy');
            Route::get('/get-by-rw/{rwId}', [RtController::class, 'getByRw'])->name('get-by-rw');
            Route::post('/{id}/set-ketua', [RtController::class, 'setKetua'])->name('set_ketua');
        });

        // LEMBAGA DESA (Full CRUD)
        Route::prefix('lembaga')->name('admin.lembaga.')->group(function () {
            Route::get('/', [LembagaDesaController::class, 'index'])->name('index');
            Route::get('/create', [LembagaDesaController::class, 'create'])->name('create');
            Route::post('/', [LembagaDesaController::class, 'store'])->name('store');
            Route::get('/{lembaga}', [LembagaDesaController::class, 'show'])->name('show');
            Route::get('/{lembaga}/edit', [LembagaDesaController::class, 'edit'])->name('edit');
            Route::put('/{lembaga}', [LembagaDesaController::class, 'update'])->name('update');
            Route::delete('/{lembaga}', [LembagaDesaController::class, 'destroy'])->name('destroy');
            
            // Routes untuk dokumen
            Route::group(['prefix' => '{lembaga}/dokumen'], function () {
                Route::get('/{id}/show', [LembagaDesaController::class, 'showFile'])->name('dokumen.show');
                Route::get('/{id}/download', [LembagaDesaController::class, 'downloadDokumen'])->name('dokumen.download');
                Route::delete('/{id}', [LembagaDesaController::class, 'hapusDokumen'])->name('dokumen.hapus');
                Route::get('/{id}/details', [LembagaDesaController::class, 'getFileDetails'])->name('dokumen.details');
                Route::get('/api/dokumen/{id}/details', [LembagaDesaController::class, 'getFileDetailsApi'])->name('dokumen.api.details');
            });

            // Anggota Lembaga
            Route::prefix('{lembaga_id}/anggota')->name('anggota.')->group(function () {
                Route::get('/', [AnggotaLembagaController::class, 'index'])->name('index');
                Route::get('/create', [AnggotaLembagaController::class, 'create'])->name('create');
                Route::post('/', [AnggotaLembagaController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [AnggotaLembagaController::class, 'edit'])->name('edit');
                Route::put('/{id}', [AnggotaLembagaController::class, 'update'])->name('update');
                Route::delete('/{id}', [AnggotaLembagaController::class, 'destroy'])->name('destroy');
            });

            // Jabatan Lembaga
            Route::prefix('{lembaga_id}/jabatan')->name('jabatan.')->group(function () {
                Route::get('/', [JabatanLembagaController::class, 'index'])->name('index');
                Route::get('/create', [JabatanLembagaController::class, 'create'])->name('create');
                Route::post('/', [JabatanLembagaController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [JabatanLembagaController::class, 'edit'])->name('edit');
                Route::put('/{id}', [JabatanLembagaController::class, 'update'])->name('update');
                Route::delete('/{id}', [JabatanLembagaController::class, 'destroy'])->name('destroy');
            });
        });
    });
});