<?php

namespace App\Http\Controllers;

use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        // Ambil tanggal hari ini
        $today = Carbon::today();

        $products = product::with('kategoris','sizeUnit','divisi_outputs')
                    ->dashboardFilter()
                    ->orderBy('deadline', 'asc')->get()
                    ->filter(function ($product){
                        return $product->progress < 100;
                    });

        // Produk outstanding (progress < 100 atau belum selesai)
        $outstandingCount = $products->count();

        // Produk hari ini deadline
        $todayDeadline = Product::dashboardFilter()
                        ->get()->filter(function ($product){
                            return $product->progress < 100;
                        })
                        ->where('deadline', '=', $today);
        $todayDeadlineCount = $todayDeadline->count();

        // Produk mendekati deadline (H-3)
        $nearDeadline = Product::dashboardFilter()
                        ->get()->filter(function ($product){
                            return $product->progress < 100;
                        })
                        ->where('deadline', '>=', $today)
                        ->where('deadline', '<=', $today->copy()->addDays(3));
        $nearDeadlineCount = $nearDeadline->count();

        // Produk melebihi deadline
        $overdue = Product::dashboardFilter()
                        ->get()->filter(function ($product){
                            return $product->progress < 100;
                        })
                        ->where('deadline', '<', $today);
        $overdueCount = $overdue->count();

        // Menggabungkan kedua collection
        $combined = $nearDeadline->merge($overdue);
        $combined = $combined->sortBy('deadline');

        $warningDeadline = $nearDeadlineCount + $overdueCount;

        // Mengelompokkan produk berdasarkan bulan dan menghitung jumlahnya
        $productData = Product::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', Carbon::now()->year) // Filter untuk tahun ini
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        // Menyiapkan data untuk Chart.js
        $chartDataProducts = [
            'labels' => $productData->pluck('month')->map(function ($month) {
                return Carbon::create()->month($month)->format('F'); // Konversi angka bulan ke nama bulan
            }),
            'data' => $productData->pluck('total'),
        ];

        $categoryData = product::selectRaw('kategori_id, COUNT(*) as total')
                    ->groupBy('kategori_id')
                    ->with('kategoris') // Pastikan relasi kategori ada di model Product
                    ->get();

        $chartDataCategories = [
            'labels' => $categoryData->pluck('kategoris.name'), // Nama kategori
            'data' => $categoryData->pluck('total'), // Jumlah produk per kategori
        ];

        return view('dashboard.index', compact(
            'products',
            'outstandingCount',
            'warningDeadline',
            'todayDeadlineCount',
            'chartDataProducts',
            'chartDataCategories',
            'combined'
        ));
    }

    public function show($id)
    {
        $product = product::with(['kategoris', 'sizeUnit', 'divisi_outputs'])->findOrFail($id);

        // Hitung total qty
        $totalQty = $product->sizeUnit->sum('pivot.qty');

        return view('dashboard.show', compact('product', 'totalQty'));
    }
}
