<?php


use App\Models\Category;
use App\Http\Livewire\Blank;
use App\Http\Livewire\Users;
use App\Http\Livewire\Measures;
use App\Http\Livewire\Customers;
use App\Http\Livewire\Categories;
use App\Http\Livewire\CuentasPorCobrar;
use App\Http\Livewire\Products;
use App\Http\Livewire\Sales;
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
Route::get('categories', Categories::class)->name('categories');
Route::get('users', Users::class)->name('users');
Route::get('customers', Customers::class)->name('customers');
Route::get('products', Products::class)->name('products');
Route::get('sales', Sales::class)->name('sales');
Route::get('payments', CuentasPorCobrar::class)->name('payments');
