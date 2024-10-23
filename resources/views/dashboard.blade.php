@extends('layout')
@section('content')
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                Dashboard
            </div>
            <div class="card-body">
                <a href="{{ route('buku.index') }}" class="btn btn-primary">Book Page</a>
            </div>
        </div>
    </div>
@endsection
