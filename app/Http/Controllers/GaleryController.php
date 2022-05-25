<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Galery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class GaleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeries = Galery::latest()->paginate(9);
        return Inertia::render('Galery/Galery', [
            'title' => "Galeri",
            "categories" => Category::all(),
            "galeries" => $galeries
        ]);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Galery/Create', [
            "title" => "Tambah Galeri",
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
        $data = $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [], [
            'title' => 'judul',
            'image' => 'gambar'
        ]);

        if ($request->file('image')) {
            $ext = str_replace(' ', '-', $request->get('title'));
            $filename = strtolower($ext) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs(
                'galery', $filename, 'public'
            );
        }
        $data['title'] = Str::title($request->get('title'));
        // return $data;
        Galery::create($data);

        return redirect()->route('dashboard.gallery')
            ->with('message', 'Galeri berhasil ditambahkan.');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\Galery  $galery
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Galery $galery)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function edit(Galery $galery)
    {
        return Inertia::render('Galery/Edit', [
            "title" => "Edit Galeri",
            "galeries" => $galery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Galery $galery)
    {
        $data = $request->validate([
            'title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ], [], [
            'image' => 'gambar'
        ]);

        if ($request->file('image')) {
            if ($galery->image) {
                Storage::disk('public')->delete($galery->image);
            }
            $ext = str_replace(' ', '-', $request->get('title'));
            $filename = strtolower($ext) . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image'] = $request->file('image')->storeAs(
                'galery', $filename, 'public'
            );
        }
        // return $data;
        Galery::where('id', $galery->id)
            ->update($data);

        return redirect()->route('dashboard.gallery')
            ->with('message', 'Galeri berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galery  $galery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Galery $galery)
    {
        if ($galery->image) {
            Storage::disk('public')->delete($galery->image);
        }

        Galery::destroy($galery->id);

        return redirect()->route('dashboard.gallery')
            ->withSuccess(__('Galery berhasil dihapus.'));
    }
}
