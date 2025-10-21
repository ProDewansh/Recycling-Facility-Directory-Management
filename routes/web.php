<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileController;

// -------- Original Facility & Material Routes (auth protected) --------
Route::middleware('auth')->group(function () {

    // Material Routes
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');

    // Facility Routes
    Route::get('/', [FacilityController::class,'index'])->name('facilities.index');
    Route::get('/facilities/create', [FacilityController::class,'create'])->name('facilities.create');
    Route::post('/facilities', [FacilityController::class,'store'])->name('facilities.store');
    Route::get('/facilities/{facility}/edit', [FacilityController::class,'edit'])->name('facilities.edit');
    Route::put('/facilities/{facility}', [FacilityController::class,'update'])->name('facilities.update');
    Route::delete('/facilities/{facility}', [FacilityController::class,'destroy'])->name('facilities.destroy');
    Route::get('/facilities/{facility}', [FacilityController::class,'show'])->name('facilities.show');
    Route::get('/export/csv', [FacilityController::class,'exportCsv'])->name('facilities.export');

    // -------- Breeze Profile Routes --------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -------- Public / Dashboard Routes --------
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Breeze auth routes
require __DIR__.'/auth.php';
