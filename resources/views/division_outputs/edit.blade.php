@extends('layout.app')

@section('title', 'Edit Output')

@section('content')
<div class="container">
    <h2 class="mb-3">Add Division Output</h2>
    <form action="{{ route('inputdivisi.update' , $inputdivisi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="current-date" class="form-label">Tanggal</label>
                <input type="date" id="current-date" name="input_date" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="division_id" class="form-label">Division</label>
                <select name="division_id" id="division_id" class="form-control" required>
                    <option value="{{ old("division_id", $inputdivisi->division->id)}}">{{ $inputdivisi->division->name }}</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="product_id" class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="{{ old("product_id", $inputdivisi->products->id)}}">{{ $inputdivisi->products->name_product }}</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name_product }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="unit_size_id" class="form-label">Size</label>
                <select name="unit_size_id" id="unit_size_id" class="form-control" required>
                    <option value="{{ old("unit_size_id", $inputdivisi->unitSize->id)}}">{{ $inputdivisi->unitSize->name }}</option>
                    @if(old('unit_size_id'))
                        <option value="{{ old('unit_size_id') }}" selected>
                            {{ old('unit_size_id') }}
                        </option>
                    @endif
                </select>
            </div>
            <div class="col-md-6">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" name="qty" id="qty" class="form-control" min="1" value="{{ $inputdivisi->qty }}" required>
            </div>
        </div>


        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        <a href="{{ route('inputdivisi.index') }}" class="btn btn-warning mt-3 ml-3">Kembali</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productSelect = document.getElementById('product_id');
        const sizeSelect = document.getElementById('unit_size_id');

        productSelect.addEventListener('change', () => {
            const productId = productSelect.value;
            sizeSelect.innerHTML = '<option value="">-- Select Size --</option>';

            if (productId) {
                fetch(`/api/products/${productId}/sizes`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(size => {
                            const option = document.createElement('option');
                            option.value = size.id;
                            option.textContent = size.name;
                            sizeSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching sizes:', error));
            }
        });
    });

    // Set the input date field to today's date
    document.addEventListener('DOMContentLoaded', () => {
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format YYYY-MM-DD
        document.getElementById('current-date').value = formattedDate;
    });
</script>

@endsection
