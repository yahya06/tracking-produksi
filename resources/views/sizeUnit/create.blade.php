@extends('layout.app')

@section('content')
<div class="container">
    <h1>Add Size</h1>
    <form action="{{ route('sizeunit.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Division Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('sizeunit.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>
@endsection