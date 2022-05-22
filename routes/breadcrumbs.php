<?php // routes/breadcrumbs.php

use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
     $trail->push('Home', route('home'));
});

Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
     $trail->parent('home');
     $trail->push('Produk', route('produk'));
});

Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
     $trail->parent('product');
     $trail->push($category, route('category', $category));
});

Breadcrumbs::for('stock', function (BreadcrumbTrail $trail, Product $stock) {
     $trail->parent('product');
     $trail->push($stock->title, route('products.show', $stock));
 });
