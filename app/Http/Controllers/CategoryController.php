<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Category/Categories', [
            'title' => 'Categories',
            'categories' => Category::orderBy('name', 'ASC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $data['name'] = Str::title($request->get('name'));
        Category::create($data);
        return redirect()->route('dashboard.category')->with('message', "Category $request->name add successfully!");
    }

    public function edit(Category $category)
    {
        return Inertia::render('Category/Edit', [
            "title" => "Dashboard - Kategori | Edit",
            "category" => $category,
            "categories" => Category::all()
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $data['name'] = Str::title($request->get('name'));
        // dd($data);
        Category::where(
            'id',
            $category->id
        )->update($data);
        return redirect()->route('dashboard.category')->with('message', "Category $request->name edit successfully!");
    }
}
