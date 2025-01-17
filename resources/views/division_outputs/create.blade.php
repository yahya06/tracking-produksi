@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Add Division Output</h2>
    <form action="{{ route('inputdivisi.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-2">
                <label for="current-date" class="form-label">Tanggal</label>
                <input type="date" id="current-date" name="input_date" class="form-control" readonly>
            </div>
            <div class="col-md-2">
                <label for="division_id" class="form-label">Division</label>
                <select name="division_id" id="division_id" class="form-control" required>
                    <option value="">-- Select Division --</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="product_id" class="form-label">Kode Product</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">-- Select Product --</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->code_product }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="name_product" class="form-label">Nama Product</label>
                <input type="text" id="name_product" name="name_product" class="form-control" readonly>
            </div>
            <div class="col-md-2">
                <label for="customer" class="form-label">Customer</label>
                <input type="text" id="customer" name="customer" class="form-control" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="unit_size_id" class="form-label">Size</label>
                <select name="unit_size_id" id="unit_size_id" class="form-control" required>
                    <option value="">-- Select Size --</option>
                    @if(old('unit_size_id'))
                        <option value="{{ old('unit_size_id') }}" selected>
                            {{ old('unit_size_id') }}
                        </option>
                    @endif
                </select>
            </div>
            <div class="col-md-6">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" name="qty" id="qty" class="form-control" min="1" value="{{ old('qty') }}" required>
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
        const nameProduct = document.getElementById('name_product');
        const customerProduct = document.getElementById('customer');


        productSelect.addEventListener('change', () => {
            const productId = productSelect.value;
            sizeSelect.innerHTML = '<option value="">-- Select Size --</option>';

            // Reset fields if no product selected
            if (!productId) {
                nameProduct.value = '';
                customerProduct.value = '';
                return;
            }
            // Fetch product details
            fetch(`/api/products/${productId}`)
                .then(response => response.json())
                .then(data => {
                    nameProduct.value = data.name_product || 'Unknown';
                    customerProduct.value = data.customer || 'Unknown';
                })
                .catch(error => {
                    console.error('Error fetching product details:', error);
                    nameProduct.value = '';
                    customerProduct.value = '';
            });

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
