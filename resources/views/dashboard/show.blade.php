@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="row d-flex align-items-center justify-content-between mb-3">
        <h1 class="">Detail Produk</h1>
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Kembali ke Dashboard Produk</a>
    </div>
    <div class="row mb-3 d-flex justify-content-between">
        <div class="col-md-6 row">
            <div class="col-4">Kode Produk</div>
            <div class="col-8">: {{ $product->code_product }}</div>
            <div class="col-4">Nama Produk</div>
            <div class="col-8">: {{ $product->name_product }}</div>
            <div class="col-4">Kategori</div>
            <div class="col-8">: {{ $product->kategoris->name ?? '-' }}</div>
        </div>
        <div class="col-md-6 row">
            <div class="col-4">Customer</div>
            <div class="col-8">: {{ $product->customer }}</div>
            <div class="col-4">Deadline</div>
            <div class="col-8">: {{ $product->deadline }}</div>
            <div class="col-4">Total Order</div>
            <div class="col-8">: {{ $totalQty }} Pcs</div>
        </div>
        <div class="col-md-12">
            @if(!$product->is_completed)
            <form action="{{ route('products.complete', $product->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success btn-sm mt-4">Mark as Completed</button>
            </form>
            @endif
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Ukuran</th>
                <th>Qty</th>
                @foreach ($product->divisi_outputs->groupBy('division_id') as $divisionId => $outputs )
                    <th>{{ $outputs->first()->division->name }}</th>
                @endforeach
            </tr>
            @foreach ($product->sizeUnit as $size)
                <tr>
                    <td>{{ $size->name }}</td>
                    <td>{{ $size->pivot->qty }}</td>
                    @foreach ($product->divisi_outputs->groupBy('division_id') as $divisionId => $outputs )
                        @php
                            $output = $outputs->firstWhere('unit_size_id', $size->id);
                        @endphp
                        <td>{{ $output ? $output->qty : '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
