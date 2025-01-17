@extends('layout.app')

@section('content')
<div class="container-fluid">
    <h1>Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Add Division</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->name }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
