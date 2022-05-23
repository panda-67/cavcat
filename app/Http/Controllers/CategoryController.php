<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Product/Categories', [
            'title' => 'Categories',
            'category' => Category::latest()->get()
        ]);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $data['name'] = Str::title($request->get('name'));
        Category::create($data);
        return redirect()->route('dashboard')->with('message', "Category $request->name add successfully!");
    }
}
