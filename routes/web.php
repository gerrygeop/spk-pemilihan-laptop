<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\{
    KriteriaController,
    AlternatifController,
    RepresentasiController,
};


Route::get('/', function () {
    return view('welcome');
});

// Middelware Auth
Route::middleware(['auth'])->group(function () {

    // Redirect to check role
    Route::get("/redirectAuthenticatedUsers", [RedirectAuthenticatedUsersController::class, "home"]);

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Dashboard Admiral & Prefix /d
    Route::middleware(['checkRole:admiral'])->prefix('d')->name('d.')->group(function() {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
        // Kriteria
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
        Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
        Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
        
        // Alternatif
        Route::get('/alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
        Route::post('/alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
        Route::get('/alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
        Route::delete('/alternatif/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');
        Route::get('/alternatif/{alternatif}', [AlternatifController::class, 'show'])->name('alternatif.show');
        Route::put('/alternatif/{alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');
        Route::get('/alternatif/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');

        // Representasi
        Route::get('/representasi', [RepresentasiController::class, 'index'])->name('representasi.index');
        Route::post('/representasi/{kriteria}', [RepresentasiController::class, 'store'])->name('representasi.store');
        Route::get('/representasi/{kriteria}/create', [RepresentasiController::class, 'create'])->name('representasi.create');
        Route::delete('/representasi/{kriteria}/{representasi}', [RepresentasiController::class, 'destroy'])->name('representasi.destroy');
        Route::put('/representasi/{representasi}', [RepresentasiController::class, 'update'])->name('representasi.update');
        Route::get('/representasi/{kriteria}/edit/{representasi}', [RepresentasiController::class, 'edit'])->name('representasi.edit');
    });
    
});

require __DIR__.'/auth.php';
