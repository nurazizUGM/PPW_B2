@extends('layout')
@section('title', '- Tambah Buku')

@section('content')
    <div class="container mt-3">
        <form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit"
                    value="{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y-m-d') }}">
            </div>
            @if ($buku->photo)
                <img src="{{ asset('storage/buku/' . $buku->photo) }}" alt="Foto Sampul" class="img-thumbnail mb-2"
                    style="max-width: 200px">
            @endif
            <div class="mb-3">
                <label for="photo" class="form-label">Ganti Foto Sampul</label>
                <input type="file" class="form-control" name="photo" id="photo">
                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('buku.index') }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
@endsection
