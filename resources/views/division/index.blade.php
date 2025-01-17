@extends('layout.app')

@section('content')
<div class="container-fluid">
    <h1>Divisions</h1>
    <a href="{{ route('division.create') }}" class="btn btn-primary mb-3">Add Division</a>

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
            @foreach ($division as $division)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $division->name }}</td>
                <td>
                    <a href="{{ route('division.edit', $division->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('division.destroy', $division->id) }}" method="POST" class="d-inline">
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
