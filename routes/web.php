<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TourController as AdminTourController;
use App\Http\Controllers\Admin\ReservaController as AdminReservaController;
use App\Http\Controllers\Guia\TourController as GuiaTourController;
use App\Http\Controllers\ReservaController as TuristaReservaController;
use App\Models\Tour;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    $toursDestacados = Tour::with('categoria')
        ->activos()
        ->orderBy('fecha_salida')
        ->take(3)
        ->get();

    return view('home', compact('toursDestacados'));
})->name('home');

Route::get('/tours', [TourController::class, 'index'])
    ->middleware('auth')
    ->name('tours.index');
// Route::middleware('auth')->group(function () {
//     Route::get('/tours', [TourController::class, 'index'])
//         ->name('tours.index');
// });

Route::get('/tours/{tour:slug}', [TourController::class, 'show'])
    ->name('tours.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas exclusivas del Administradoras
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('tours', AdminTourController::class)
        ->except(['show']);

    Route::get('/reservas', [AdminReservaController::class, 'index'])
        ->name('reservas.index');

    Route::patch('/reservas/{reserva}/estado', [AdminReservaController::class, 'estado'])
        ->name('reservas.estado');

    });

// Rutas exclusivas del guía
Route::middleware(['auth', 'role:guia'])
    ->prefix('guia')
    ->name('guia.')
    ->group(function () {

        Route::get('/tours', [GuiaTourController::class, 'index'])
            ->name('tours');
    });

// rutas exclusivas del turista.
Route::middleware(['auth', 'role:turista'])->group(function () {
    // registrar una reserva.
    Route::post('/tours/{tour}/reservas', [TuristaReservaController::class, 'store'])
        ->name('reservas.store');

    //mostar reservas del turista.
    Route::get('/mis-reservas', [TuristaReservaController::class, 'mias'])
        ->name('reservas.mias');

    // cancelar una reserva.
    Route::patch('/reservas/{reserva}/cancelar', [TuristaReservaController::class, 'cancelar'])
        ->name('reservas.cancelar');
});

require __DIR__.'/auth.php';
