@extends('layout')

@section('title', '- Tambah Buku')

@section('content')
    <div class="container mt-3">
        <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul">
                @error('judul')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
                @error('penulis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga">
                @error('harga')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit">
                @error('tgl_terbit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto Sampul</label>
                <input type="file" class="form-control" name="photo" id="photo">
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="flex justify-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('buku.index') }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
@endsection
