@extends('layout')
@section('title', '- Buku')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ 'Rp. ' . number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ date('d/m/Y', strtotime($buku->tgl_terbit)) }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
