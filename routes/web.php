<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GaleryController;
use App\Models\Category;
use App\Models\Product;
use App\Models\Galery;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $products = Product::with('category')->latest()->limit(4)->get();
    $galeries = Galery::latest()->limit(4)->get();
    return Inertia::render('Welcome', [
        "title" => "Welcome",
        "products" => $products,
        "galeries" => $galeries,
        "categories" => Category::all()
    ]);
})->name('home')->breadcrumb('Beranda');

Route::get('/dashboard', function () {    
    return Inertia::render('Dashboard', [
        "title" => "Dashboard",
        "categories" => Category::all(),
        "products" => Product::with('category')->latest()->paginate(10)
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('products', ProductController::class)
    ->except(['index', 'show'])
    ->middleware(['auth']);

Route::get('/products', [ProductController::class, 'index'])
    ->name('produk')
    ->breadcrumb('Produk', 'home');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show')
    ->breadcrumb('', 'produk');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::post('category/store', [CategoryController::class, 'store'])
	->middleware('auth')->name('category.store');

Route::get('/products?category={category:slug}')->name('category');

Route::get('/galeries', [GaleryController::class, 'index'])->name('galery');

Route::resource('/galeries', GaleryController::class)->except([
    'index'
])->middleware(['auth']);