@extends('layout.app')

@section('content')
<div class="container-fluid">
    <h1>User Management</h1>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>AddRole</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td>
                    <form action="{{ route('users.assignRole', $user->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <select name="role" class="form-control">
                                    <option value="Guest">Guest</option>
                                    <option value="SuperAdmin">SuperAdmin</option>
                                    <option value="Manajer">Manajer</option>
                                    <option value="AdminProduksi">AdminProduksi</option>
                                    <option value="Spv">Spv</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Assign</button>
                            </div>
                        </div>
                    </form>
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
