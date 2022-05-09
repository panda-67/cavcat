<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GaleryController;
use App\Models\Category;
use App\Models\Product;
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
    $product = Product::orderBy("created_at", "desc")->first();
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        "title" => "Welcome",
        "product" => $product,
        "categories" => Category::all()
    ]);
})->name('home');

Route::get('/dashboard', function () {
    $products = Product::orderBy("created_at", "desc")->paginate(10);
    return Inertia::render('Dashboard', [
        "title" => "Dashboard",
        "categories" => Category::all()
    ], compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('products', ProductController::class)->except([
    'index', 'show'
])->middleware(['auth']);

Route::get('/products', [ProductController::class, 'index'])->name('produk');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::post('category/store', [CategoryController::class, 'store'])
	->middleware('auth')->name('category.store');

Route::get('/products?category={category:slug}')->name('category');

Route::get('/galeries', [GaleryController::class, 'index'])->name('galery');

Route::resource('/galeries', GaleryController::class)->except([
    'index'
])->middleware(['auth']);