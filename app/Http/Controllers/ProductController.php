<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $namecategory = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $namecategory = $category->name;
        }

        $products = Product::with('category')->latest()->filter(request(['search', 'category']))->paginate(12);

        return Inertia::render('Product/Produk', [
            "title" => "Products",
            "categoryName" => $namecategory,
            "categories" => Category::latest()->get(),
            "products" => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Product/Create', [
            "title" => "Tambah",
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('display')->store('gambar');

        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'merk' => 'bail|required|string',
            'display' => 'image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
            'price' => 'bail|required|numeric|between:0,9999999.99'
        ], [], [
            'title' => 'judul',
            'category_id' => 'kategori',
            'merk' => 'merek',
            'display' => 'gambar',
            'description' => 'deskripsi',
            'price' => 'harga'
        ]);

        if ($request->file('display')) {
            $ext = str_replace(' ', '-', $request->get('title'));
            $filename = strtolower($ext) . '.' . $request->file('display')->getClientOriginalExtension();
            $data['display'] = $request->file('display')->storeAs(
                'gambar',
                $filename,
                'public'
            );
        }
        $data['title'] = Str::title($request->get('title'));
        // return $data;
        Product::create($data);

        return redirect()->route('dashboard')
            ->with('message', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $slug)
    {
        $stock = $product->with('category')->where('slug', $slug)->first();
        return Inertia::render('Product/Show', [
            "title" => "Detail",
            "stock" => $stock,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/Edit', [
            "title" => "Edit",
            "categories" => Category::all(),
            "product" => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'merk' => 'bail|required|string',
            'display' => 'nullable',
            'description' => 'required',
            'price' => 'bail|required|numeric|between:0,9999999.99'
        ], [], [
            'title' => 'judul',
            'category_id' => 'kategori',
            'merk' => 'merek',
            'display' => 'gambar',
            'description' => 'deskripsi',
            'price' => 'harga'
        ]);

        if ($request->file('display')) {
            $ext = str_replace(' ', '-', $request->get('title'));
            $filename = strtolower($ext) . '.' . $request->file('display')->getClientOriginalExtension();
            $data['display'] = $request->file('display')->storeAs(
                'gambar',
                $filename,
                'public'
            );
        }
        $data['title'] = Str::title($request->get('title'));
        // return $request;
        Product::where(
            'id',
            $product->id
        )->update($data);

        return redirect()->route('dashboard')
            ->with('message', 'Produk berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->display) {
            Storage::disk('public')->delete($product->display);
        }

        Product::destroy($product->id);

        return redirect()->route('dashboard')
            ->withSuccess(__('Produk berhasil dihapus.'));
    }
}
