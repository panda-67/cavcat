<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('product.categories', [
            'title' => 'Categories',
            'category' => Category::latest()->get(),
            "categories" => Category::all()
        ]);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        Category::create($data);
        return redirect()->route('dashboard')->with('message', "Category $request->name add successfully!");
    }
}
