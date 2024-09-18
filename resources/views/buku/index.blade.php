@extends('layout')
@section('title', '- Buku')

@section('content')
    <div class="container mt-3">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
        <table class="table mt-3">
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
                {{-- @foreach ($data_buku as $buku) --}}
                @foreach ($data_buku->values() as $i => $buku)
                    <tr>
                        {{-- <td>{{ $loop->iteration }}</td> --}}
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>Rp. {{ number_format($buku->harga, 2, ',', '.') }}</td>
                        {{-- tanpa library --}}
                        {{-- <td>{{ date('d/m/Y', strtotime($buku->tgl_terbit)) }}</td> --}}

                        {{-- casting via model --}}
                        {{-- <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td> --}}

                        {{-- dengan carbon --}}
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah anda yakin?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <caption>
                <span>Total: {{ $jumlah }} buku</span>
                <br>
                <span>Total harga: Rp. {{ number_format($total_harga, 2, ',', '.') }}</span>
            </caption>
        </table>
    </div>
@endsection


{{-- @section('script')
    <script>
        @if (session('success'))
            alert('{{ session('success') }}');
        @endif
    </script>
@endsection --}}
