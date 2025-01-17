<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\product;
use App\Models\size;
use App\Models\sizeUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::with('kategoris')->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = kategori::all();
        $unitSize = sizeUnit::all();

        return view('product.create', compact('category', 'unitSize'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'code_product' => 'required|unique:products',
            'name_product' => 'required',
            'customer' => 'required',
            'deadline' => 'required|date',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'sizeUnit' => 'required|array',
            'sizeUnit.*.size_unit_id' => 'required|exists:size_units,id',
            'sizeUnit.*.qty' => 'required|integer|min:1',
        ]);

        // Debug untuk memastikan validasi berhasil
        // dd('Validasi berhasil, lanjut ke penyimpanan data!');

        $product = product::create([
            'code_product'  => $request->code_product,
            'name_product'  => $request->name_product,
            'customer'      => $request->customer,
            'deadline'      => $request->deadline,
            'kategori_id'   => $request->kategori_id,
        ]);

        foreach($request->sizeUnit as $size){
            $product->sizeUnit()->attach($size['size_unit_id'], ['qty' => $size['qty']]);
        };

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('kategoris', 'sizeUnit')->findOrFail($id);

        // Hitung total qty
        $totalQty = $product->sizeUnit->sum('pivot.qty');

        return view('product.show', compact('product', 'totalQty'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = product::with(['sizes.size_units'])->findOrFail($id);
        $kategori = kategori::all();
        $unitSize = sizeUnit::all();

        // dd($product->sizes);
        return view('product.edit', compact('product', 'kategori', 'unitSize'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = product::findOrfail($id);

        $validated = $request->validate([
            'code_product'          => 'required|unique:products,code_product,' . $id,
            'name_product'          => 'required',
            'customer'              => 'required',
            'deadline'              => 'required|date',
            'kategori_id'           => 'nullable|exists:kategoris,id',
            'sizeUnit'                  => 'required|array',
            'sizeUnit.*.size_unit_id'   => 'required|exists:size_units,id',
            'sizeUnit.*.qty'            => 'required|integer|min:1',
        ]);

        $product->update([
            'code_product' => $validated['code_product'],
            'name_product' => $validated['name_product'],
            'customer' => $validated['customer'],
            'deadline' => $validated['deadline'],
            'kategori_id' => $validated['kategori_id'],
        ]);

        // $product->sizeUnit()->delete(); // Hapus data ukuran lama
        $product->sizeUnit()->detach();
        foreach ($validated['sizeUnit'] as $size){
            $product->sizeUnit()->attach($size['size_unit_id'], ['qty' => $size['qty']]);
        };

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = product::findOrfail($id);
        $product->sizeUnit()->detach();
        $product->delete();

        return redirect()->route('product.index');
    }

    public function markAsCompleted($id)
    {
        $product = Product::findOrFail($id);
        $product->is_completed = true; // Tandai produk sebagai selesai
        $product->save();

        return redirect()->route('dashboard.index')->with('success', 'Product marked as completed.');
    }
}
