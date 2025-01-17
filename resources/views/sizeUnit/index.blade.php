@extends('layout.app')

@section('content')
<div class="container-fluid">
    <h1>Size</h1>
    <a href="{{ route('sizeunit.create') }}" class="btn btn-primary mb-3">Add Size</a>

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
            @foreach ($sizeUnit as $sUnit)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sUnit->name }}</td>
                <td>
                    <a href="{{ route('sizeunit.edit', $sUnit->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('sizeunit.destroy', $sUnit->id) }}" method="POST" class="d-inline">
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
