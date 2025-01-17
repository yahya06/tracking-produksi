@extends('layout.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Kategori Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $kategori->name) }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection
