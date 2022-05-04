<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RedirectAuthenticatedUsersController;
use App\Http\Controllers\{
    KriteriaController,
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
        
        Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
        Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
        Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
        Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::get('/kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    });
    
});

require __DIR__.'/auth.php';
