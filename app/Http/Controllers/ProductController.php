<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

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

        return view('product.produk', [
            "title" => "Products",
            "categoryName" =>$namecategory,
            "categories" => Category::latest()->get(),
        ], compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create', [
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
            'display' => 'picture',
            'description' => 'deskripsi',
            'price' => 'harga'
        ]);

        if ($request->file('display')) {
            $ext = str_replace(' ', '-', $request->get('title'));
            $filename = strtolower($ext) . '.' . $request->file('display')->getClientOriginalExtension();
            $data['display'] = $request->file('display')->storeAs(
                'gambar', $filename
            );
        }
        // return $data;
        Product::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $slug)
    {
        //
        $stock = Product::where('slug', $slug)->first();
        return view('product.show', ["title" => "Detail"], compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', [
            "title" => "Edit",
            "categories" => Category::all()
        ],  compact('product'));
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
            'merk' => 'required',
            'display' => 'image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
            'price' => 'bail|required|numeric|between:0,9999999.99'
        ], [], [
            'title' => 'judul',
            'category_id' => 'kategori',
            'merk' => 'merek',
            'display' => 'picture',
            'description' => 'deskripsi',
            'price' => 'harga'
        ]);

        if ($request->file('display')) {
            if ($product->display) {
                Storage::delete($product->display);
            }
            $ext = str_replace(' ', '-', $request->get('title'));
            $filename = strtolower($ext) . '.' . $request->file('display')->getClientOriginalExtension();
            $data['display'] = $request->file('display')->storeAs(
                'gambar',
                $filename
            );
        }

        // return $request;
        Product::where(
            'id',
            $product->id
        )->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Produk berhasil diubah.');
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
            Storage::delete($product->display);
        }

        Product::destroy($product->id);

        return redirect()->route('dashboard')
            ->withSuccess(__('Produk berhasil dihapus.'));
    }
}