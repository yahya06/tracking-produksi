<?php

namespace App\Http\Controllers;

use App\Models\division;
use App\Models\divisionOutput;
use App\Models\product;
use App\Models\sizeUnit;
use Illuminate\Http\Request;

class DivisionOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisionOutputs = DivisionOutput::with(['products', 'division', 'unitSize'])
                    ->orderBy('input_date', 'desc')
                    ->get();

        $contributor = divisionOutput::selectRaw('division_id, COUNT(*) as total')
                    ->groupBy('division_id')
                    ->with('division') // Pastikan relasi division sudah diatur di model DivisionOutput
                    ->orderBy('total', 'DESC') // Mengurutkan dari yang terbesar
                    ->get();

        // dd($contributor);
        // Format data untuk Chart.js
        $chartData = [
            'labels' => $contributor->pluck('division.name'), // Mengambil nama divisi
            'data' => $contributor->pluck('total'), // Total input per divisi
            // 'datasets' => [
            //     [
            //         'label' => 'Total Input Per Divisi',
            //         'data' => $contributor->pluck('total'), // Total input per divisi
            //         'backgroundColor' => [
            //             '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384'
            //         ],
            //         'borderColor' => '#000',
            //         'borderWidth' => 1,
            //     ],
            // ],
        ];

        return view('division_outputs.index', compact('divisionOutputs', 'chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = product::all();
        $divisions = division::all();

        // Tidak perlu memuat semua unit size
        return view('division_outputs.create', compact('products', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'division_id' => 'required|exists:divisions,id',
            'unit_size_id' => 'required|exists:size_units,id',
            'qty' => 'required|integer|min:1',
            'input_date' => 'required|date',
        ]);

        DivisionOutput::create($request->all());

        return redirect()->route('inputdivisi.index')->with('success', 'Division output created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(divisionOutput $divisionOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inputdivisi = divisionOutput::with(['division', 'products', 'unitSize'])->findOrfail($id);

        $products = product::all();
        $divisions = division::all();
        // dd($inputdivisi->id);
        return view('division_outputs.edit', compact('inputdivisi', 'products', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $inputdivisi = divisionOutput::findOrfail($id);
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'division_id' => 'required|exists:divisions,id',
            'unit_size_id' => 'required|exists:size_units,id',
            'qty' => 'required|integer|min:1',
            'input_date' => 'required|date',
        ]);

        $inputdivisi->update($request->all());

        return redirect()->route('inputdivisi.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $divisionOutputs = divisionOutput::findOrfail($id);
        // $divisionOutputs->products()->detach();
        // $divisionOutputs->division()->detach();
        // $divisionOutputs->unitSize()->detach();
        $divisionOutputs->delete();

        return redirect()->route('inputdivisi.index')->with('success', 'Division Output deleted successfully.');
    }

    public function getOrdersByProductAndSize($productId, $sizeUnitId)
    {
        $orders = DivisionOutput::where('product_id', $productId)
            ->where('unit_size_id', $sizeUnitId)
            ->get();

        return response()->json($orders);
    }
}
