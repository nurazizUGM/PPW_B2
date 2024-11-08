@extends('layout')
@section('content')
    <div class="card mt-3">
        <div class="card-header">Create New Post</div>
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Picture</label>
                    <input type="file" class="form-control" id="picture" name="picture">
                    @error('picture')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
