@extends('layout.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product.update' , $product->id) }}" method="POST" class="row" id="input-product">
        @csrf
        @method('PUT')
        <div class="col-md-6">
            <div class="form-group row">
                <label for="code_product" class="col-sm-3 col-form-label">Kode Produk</label>
                <div class="col-sm-9">
                    <input type="text" name="code_product" id="code_product" class="form-control mb-3" value="{{ old('code_product', $product->code_product) }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="name_product" class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                    <input type="text" name="name_product" id="name_product" class="form-control mb-3" value="{{ old('name_product', $product->name_product) }}" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="customer" class="col-sm-3 col-form-label">Customer</label>
                <div class="col-sm-9">
                    <input type="text" name="customer" id="customer" class="form-control mb-3" value="{{ old('customer', $product->customer) }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="deadline" class="mb-2">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="form-control" value="{{ old('deadline', $product->deadline) }}" required>
                </div>
                <div class="col-sm-6">
                    <label for="kategori_id" class="mb-2">Kategori</label>
                    <select class="form-control" name="kategori_id" id="kategori_id">
                        <option value="{{ old("kategori_id", $product->kategoris->id)}}">{{ $product->kategoris->name }}</option>
                        @foreach ($kategori as $cat)
                            <option value="{{ $cat->id }}"{{ old('kategori_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="sizeUnit" class="mb-3">Ukuran dan jumlah</label>
            <div id="sizeUnit">
                @foreach ($product->sizes as $index => $size)
                    <div class="size-row">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select class="form-control" name="sizeUnit[{{ $index }}][size_unit_id]" required>
                                    <option value="">-- Pilih Ukuran --</option>
                                    @foreach ($unitSize as $sizeUnit)
                                        <option value="{{ $sizeUnit->id }}"
                                            {{ $size->size_unit_id == $sizeUnit->id ? 'selected' : '' }}>
                                            {{ $sizeUnit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control qty-input" type="number" name="sizeUnit[{{ $index }}][qty]" placeholder="Jumlah" value="{{ $size->qty }}" required min="1">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger remove-size" type="button">Hapus</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="btn btn-primary mt-3" type="button" id="add-size">Tambah Ukuran</button>
            <div class="mt-3">
                <strong>Total Jumlah:</strong> <span id="total-qty">0</span>
            </div>
        </div>
        <div class="mt-3">
            <button class="btn btn-primary" type="submit">Update Produk</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary ml-3">Cancel</a>
        </div>


    </form>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // let sizeIndex = document.querySelectorAll('.size-row').length;
            let sizeIndex = {{ count($product->sizes) }};

            const sizeOptions = `
                <option value="">-- Pilih Size --</option>
                @foreach ($unitSize as $sizeUnit)
                    <option value="{{ $sizeUnit->id }}">{{ $sizeUnit->name }}</option>
                @endforeach
            `;

            const calculateTotalQty = () => {
                let totalQty = 0;
                document.querySelectorAll('.qty-input').forEach(input => {
                    totalQty += parseInt(input.value) || 0;
                });
                document.getElementById('total-qty').textContent = totalQty;
            };

            document.getElementById('add-size').addEventListener('click', () => {
                const sizeRow = document.createElement('div');
                sizeRow.className = 'size-row';
                sizeRow.innerHTML = `
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <select class="form-control" name="sizeUnit[${sizeIndex}][size_unit_id]" required>
                                ${sizeOptions}
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input class="form-control qty-input" type="number" name="sizeUnit[${sizeIndex}][qty]" placeholder="Jumlah" required min="1">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-danger remove-size" type="button">Hapus</button>
                        </div>
                    </div>
                `;
                document.getElementById('sizeUnit').appendChild(sizeRow);
                sizeIndex++;
                calculateTotalQty();
            });

            document.getElementById('sizeUnit').addEventListener('input', (e) => {
                if (e.target.classList.contains('qty-input')) {
                    calculateTotalQty();
                }
            });

            document.getElementById('sizeUnit').addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-size')) {
                    e.target.closest('.size-row').remove();
                    calculateTotalQty();
                }
            });
        });

    </script>
</div>
@endsection
