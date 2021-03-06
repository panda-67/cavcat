<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\SettingController;
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
    return Inertia::render('Welcome', [
        "title" => "Welcome",
        "products" => Product::with('category')->latest()->limit(4)->get(),
        "galeries" => Galery::latest()->limit(4)->get(),
        "categories" => Category::orderBy('name', 'ASC')->get()
    ]);
})->name('home')->breadcrumb('Beranda');


// Dashboard Route
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Product', [
            "title" => "Produk",
            "categories" => Category::all(),
            "products" => Product::with('category')->latest()->paginate(10)
        ]);
    })->middleware('verified')->name('dashboard');

    Route::get('/dashboard/galleries', function () {
        return Inertia::render('Dashboard/Gallery', [
            "title" => "Galeri",
            "galeries" => Galery::latest()->paginate(10)
        ]);
    })->name('dashboard.gallery');

    Route::get('/dashboard/category', function () {
        return Inertia::render('Dashboard/Category', [
            "title" => "Kategori",
            "categories" => Category::all()
        ]);
    })->name('dashboard.category');

    Route::get('/dashboard/setting', [SettingController::class, 'show'])
        ->name('setting');
    Route::get('/dashboard/setting/{settings}/edit', [SettingController::class, 'edit'])
        ->name('setting.edit');
    Route::patch('dashboard/setting/{settings}', [SettingController::class, 'update'])
        ->name('setting.update');
});

require __DIR__ . '/auth.php';

Route::resource('dashboard/products', ProductController::class)
    ->except(['index', 'show'])
    ->middleware(['auth']);

Route::get('/products', [ProductController::class, 'index'])
    ->name('produk')
    ->breadcrumb('Produk', 'home');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('products.show')
    ->breadcrumb('', 'produk');

Route::get('/products?category={category:slug}')->name('category');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::post('category/store', [CategoryController::class, 'store'])
    ->middleware('auth')->name('category.store');

Route::get('dashboard/category/{category}/edit', [CategoryController::class, 'edit'])
    ->name('category.edit');

Route::patch('category/{category}', [CategoryController::class, 'update'])
    ->middleware('auth')->name('category.update');

Route::get('/galleries', [GaleryController::class, 'index'])->name('gallery');

Route::resource('dashboard/galleries', GaleryController::class)->except([
    'index'
])->middleware(['auth']);
