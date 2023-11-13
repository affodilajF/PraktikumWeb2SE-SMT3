<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\GalleryController;



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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route::get('/dashboard', [BukuController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    Route::get('/buku', [BukuController::class, 'index'])->name('buku');;


});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku/create', [BukuController::class, 'store'])->name('buku.store');
    Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
    Route::post('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
    Route::post('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');


    Route::delete('/gallery/delete/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');




});

require __DIR__.'/auth.php';
