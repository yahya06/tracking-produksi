@extends('layout.app')

@section('title', 'Product')

@push('styles')
    <!-- Custom styles for this page -->
    <link href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('template/js/demo/datatables-demo.js') }}"></script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex align-items-center justify-content-between">
        <h1>Products</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Productlist</h6>
            <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name Product</th>
                            <th>Customer</th>
                            <th>Deadline</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name Product</th>
                            <th>Customer</th>
                            <th>Deadline</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->code_product }}</td>
                            <td>{{ $product->name_product }}</td>
                            <td>{{ $product->customer }}</td>
                            <td>{{ $product->deadline }}</td>
                            <td>{{ optional($product->kategoris)->name ?? 'No Category' }}</td>
                            <td>
                                <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info">Show</a>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
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
        </div>
    </div>
</div>
@endsection
