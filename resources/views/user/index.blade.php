@extends('layout')
@section('content')
    <h1>User</h1>
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Add User</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level }}</td>
                    <td>
                        @if ($user->photo)
                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" width="100">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
