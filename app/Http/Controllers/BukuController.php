<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

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
        // $buku = $request->validate([
        //     'judul' => 'required',
        //     'penulis' => 'required',
        //     'tgl_terbit' => 'required',
        //     'harga' => 'required',
        // ]);

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tgl_terbit' => $request->tgl_terbit,
            'harga' => $request->harga,
        ]);
        // return redirect()->route('buku.index')->with('success', 'Data buku berhasil ditambahkan');
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
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Buku $buku)
    public function update(Request $request, $buku)
    {
        // $data_buku = $request->validate([
        //     'judul' => 'required',
        //     'penulis' => 'required',
        //     'tgl_terbit' => 'required',
        //     'harga' => 'required',
        // ]);



        $buku = Buku::find($buku);
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tgl_terbit' => $request->tgl_terbit,
            'harga' => $request->harga,
        ]);
        // return redirect()->route('buku.index')->with('success', 'Data buku berhasil diubah');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id, Buku $buku)
    public function destroy($buku)
    {
        $buku = Buku::find($buku);
        $buku->delete();
        // return redirect()->route('buku.index')->with('success', 'Data buku berhasil dihapus');
        return redirect()->route('buku.index');
    }
}
