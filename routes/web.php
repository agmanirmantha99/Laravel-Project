<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;



Route::get('/', function () {
    return view('frontend.home');
});


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/SliderIndex','index')->name('slider.index');
    Route::post('/saveSlider','storeslider')->name('slider.store');
});

Route::get('/admin/dashboard', function () {
    if (!view()->exists('admin.dashboard')) {
        dd('View not found!');
    }
    return view('admin.dashboard');
});


require __DIR__.'/auth.php';
