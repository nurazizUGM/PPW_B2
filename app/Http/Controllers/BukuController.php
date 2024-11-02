<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_buku = Buku::all()->sortByDesc('id');
        $jumlah = $data_buku->count();
        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah', 'total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'tgl_terbit' => 'required|date',
            'harga' => 'required|integer',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/buku', $photo->hashName());

            // $image = Image::read($photo);
            // $image->cover(200, 200, 'center'); // create square image
            // $image->scale(200, 200); // scale image to 200x200 but keep aspect ratio
            // $image->toJpeg()->save(storage_path('app/public/buku/' . $photo->hashName()));
        }

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tgl_terbit' => $request->tgl_terbit,
            'harga' => $request->harga,
            'photo' => isset($photo) ? $photo->hashName() : null,
        ]);

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'tgl_terbit' => 'required|date',
            'harga' => 'required|integer',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $buku = Buku::find($id);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photo->storeAs('public/buku', $photo->hashName());

            if ($buku->photo && Storage::exists('public/buku/' . $buku->photo)) {
                Storage::delete('public/buku/' . $buku->photo);
            }
            $buku->update([
                'photo' => $photo->hashName(),
            ]);
        }

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tgl_terbit' => $request->tgl_terbit,
            'harga' => $request->harga,
        ]);
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);

        if ($buku->photo && Storage::exists('public/buku/' . $buku->photo)) {
            Storage::delete('public/buku/' . $buku->photo);
        }
        $buku->delete();
        return redirect()->route('buku.index');
    }
}
