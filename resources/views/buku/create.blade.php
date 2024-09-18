@extends('layout')

@section('title', '- Tambah Buku')

@section('content')
    <div class="container mt-3">
        <form method="POST" action="{{ route('buku.store') }}">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul">
                {{-- @if ($errors->has('judul'))
                    <div class="text-danger">{{ $errors->first('judul') }}</div>
                @endif --}}
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis">
                {{-- @if ($errors->has('penulis'))
                    <div class="text-danger">{{ $errors->first('penulis') }}</div>
                @endif --}}
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga">
                {{-- @if ($errors->has('harga'))
                    <div class="text-danger">{{ $errors->first('harga') }}</div>
                @endif --}}
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit">
                {{-- @if ($errors->has('tgl_terbit'))
                    <div class="text-danger">{{ $errors->first('tgl_terbit') }}</div>
                @endif --}}
            </div>
            <div class="flex justify-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('buku.index') }}" class="btn btn-danger">Back</a>
            </div>
        </form>
    </div>
@endsection
