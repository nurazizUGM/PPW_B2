@extends('layout')
@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $user->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email') ?? $user->email }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="level" class="form-label">Role</label>
            <select class="form-select" id="level" name="level">
                <option value="USER" @if ((old('level') ?? $user->level) == 'USER') selected @endif>User</option>
                <option value="ADMIN" @if ((old('level') ?? $user->level) == 'ADMIN') selected @endif>Admin</option>
            </select>
            @error('level')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            @if ($user->photo)
                <img id="user-photo" src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" width="100"
                    class="mb-2">
                <br>
            @endif
            <label for="photo" class="form-label">Change Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <script>
        document.getElementById('photo').addEventListener('change', function() {
            const file = this.files[this.files.length - 1];
            if (file) {
                const img = document.getElementById('user-photo');
                img.src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
