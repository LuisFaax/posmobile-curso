<?php


use App\Http\Livewire\Blank;
use App\Http\Livewire\Measures;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('blank', Blank::class);

require __DIR__ . '/auth.php';

Route::get('measures', Measures::class)->name('measures');
