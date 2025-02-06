<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/check-manifest', function () {
    $path = public_path('build/manifest.json');
    return file_exists($path) ? 'Manifest found' : 'Manifest NOT found';
});

Route::get('/check-build', function () {
    return response()->json(scandir(public_path('build')));
});

require __DIR__ . '/auth.php';
