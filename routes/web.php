<?php

use App\Http\Controllers\TachesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Redirige l'utilisateur vers le dashboard après authentification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protéger les routes avec le middleware 'auth'
Route::middleware('auth')->group(function () {
    
    // Routes liées au profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    

    // Routes liées aux tâches
    Route::get('/taches', [TachesController::class, 'index'])->name('taches.index');
    Route::get('/taches/create', [TachesController::class, 'create'])->name('taches.create');
    Route::post('/taches', [TachesController::class, 'store'])->name('taches.store');
    Route::get('/taches/{tache}/edit', [TachesController::class, 'edit'])->name('taches.edit');
    Route::put('/taches/{tache}', [TachesController::class, 'update'])->name('taches.update');
    Route::delete('/taches/{tache}', [TachesController::class, 'destroy'])->name('taches.destroy');
    Route::patch('/taches/{tache}/toggle', [TachesController::class, 'toggleCompleted'])->name('tache.toggle');
    Route::get('/taches/terminees', [TachesController::class, 'terminees'])->name('taches.terminees');
    Route::get('/taches/create-with-date/{date?}', [TachesController::class, 'createWithDate'])->name('taches.createWithDate');
    Route::get('/taches/{tache}', [TachesController::class, 'show'])->name('taches.show');
    
    // Page à propos
    Route::get('/apropos', function () {
        return view('apropos');
    })->name('apropos');

});

require __DIR__.'/auth.php';


























































































/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get(uri: '/taches', action: [TachesController::class, 'index'])->name('taches.index');
    Route::get(uri: '/taches/create', action: [TachesController::class, 'create'])->name('taches.create');
    Route::post(uri: '/taches', action: [TachesController::class, 'store'])->name('taches.store');
    Route::get (uri: '/taches/{tache)/edit', action: [TachesController::class, 'edit'])->name('taches.edit');
    Route::put (uri: '/taches/{tache}', action: [TachesController::class, 'update'])->name('taches update');
    Route::delete(uri: '/taches/{tache)', action: [TachesController::class, 'destroy'])->name('taches destroy');
    Route::patch(uri: '/taches{tache}/toggle', action: [TachesController::class,'toggleCompleted' ])->name('tache.toggle');
    Route::get (uri: '/taches/terminees', action: [TachesController:: class, 'terminees'])->name('taches.terminees');
    Route::get(uri: '/taches/create-with-date/{date?}', action: [TachesController::class, 'createWithDate'])->name('taches.createWithDate');
    Route::get (uri: '/taches/{tache}', action: [TachesController::class, 'show'])->name('taches.show');

    Route::get('/apropos', function(){
        return view('apropos');
    })->name('apropos');
        
});

require __DIR__.'/auth.php';*/
