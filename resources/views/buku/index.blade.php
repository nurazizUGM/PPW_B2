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
            @foreach ($data_buku as $index=>$buku)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>Rp. {{ number_format($buku->harga, 2, ',', '.') }}</td>
                    {{-- tanpa library --}}
                    {{-- <td>{{ date('d/m/Y', strtotime($buku->tgl_terbit)) }}</td> --}}

                    {{-- casting via model --}}
                    {{-- <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td> --}}

                    {{-- dengan carbon --}}
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <caption>
            <span>Total: {{ $jumlah }} buku</span>
            <br>
            <span>Total harga: Rp. {{ number_format($total_harga, 2, ',', '.') }}</span>
        </caption>
    </table>
@endsection
