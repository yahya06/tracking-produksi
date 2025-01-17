<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_product',
        'name_product',
        'customer',
        'deadline',
        'kategori_id',
        'is_completed' => 'boolean',
    ];

    public function kategoris() {
        return $this->belongsTo(kategori::class , 'kategori_id');
    }

    public function sizes() {
        return $this->hasMany(size::class, 'product_id');
    }

    public function divisi_outputs() {
        return $this->hasMany(divisionOutput::class, 'product_id');
    }

    public function sizeUnit() {
        return $this->belongsToMany(sizeUnit::class, 'sizes')
                    ->withPivot('qty')
                    ->withTimestamps();
    }

    public function unitSizes(){
        return $this->belongsToMany(sizeUnit::class, 'sizes', 'product_id', 'size_unit_id')
                    ->withPivot('qty');
    }

    // Fungsi untuk menghitung progres
    public function getProgressAttribute()
    {
        $totalQty = $this->sizeUnit()->sum('qty');

        $sewingDivisions = [ 4,5,6,7 ]; /* IDs untuk divisi RnD, Custom, Qonita, Toheto */

        $excSewingDivision = [ 1,2,3,8,9,10 ]; /* IDs untuk divisi kecuali RnD, Custom, Qonita, Toheto */

        // Total output dari divisi sewing yang relevan
        $sewingOutputQty = $this->divisi_outputs()
                        ->whereIn('division_id', $sewingDivisions)
                        ->sum('qty');


        $excSewingOutputQty = $this->divisi_outputs()
                        ->whereIn('division_id', $excSewingDivision)
                        ->sum('qty');
        // Menghitung total output qty dan average
        $totalOutputQty = $sewingOutputQty + $excSewingOutputQty;
        // $divisionCount = count($sewingDivisions) + count($excSewingDivision);
        // Mengambil jumlah divisi yang sudah menginputkan data output
        // $sewingDivisionCount = $this->divisi_outputs()
        //     ->whereIn('division_id', $sewingDivisions)
        //     ->distinct('division_id')
        //     ->count();
        $sewingDivisionCount = $this->divisi_outputs()
                ->whereIn('division_id', $sewingDivisions)
                ->exists() ? 1 : 0;

        $excSewingDivisionCount = $this->divisi_outputs()
            ->whereIn('division_id', $excSewingDivision)
            ->distinct('division_id')
            ->count();

        $divisionCount = $sewingDivisionCount + $excSewingDivisionCount;

        // Menghitung rata-rata output berdasarkan divisi yang aktif
        $averageOutputQty = $divisionCount > 0
        ? ($sewingOutputQty + $excSewingOutputQty) / $divisionCount
        : 0;

        return $totalQty > 0
        ? round(($averageOutputQty / $totalQty) * 100, 2)
        : 0;

        // $outputQty = $divisionCount > 0 ? $totalOutputQty / $divisionCount : 0;

        // $outputQty = $this->divisi_outputs()->average('qty');
        // dd($divisionCount);
        return $totalQty > 0 ? round(($outputQty / $totalQty) * 100, 2) : 0;
    }

    // Scope untuk memfilter produk yang muncul di dashboard
    // public function scopeDashboardFilter($query)
    // {
    //     $totalQty = $this->sizeUnit()->sum('qty');
    //     $outputQty = $this->divisi_outputs()->average('qty');

    //     return $query->where(function ($query) {
    //         $query->where('is_completed', false)
    //             ->where(function ($query) {
    //                 $query->whereHas('divisi_outputs', function ($query) {
    //                     $query->where('division_id', 10); // Divisi Packing
    //                 }, '=', 0) // Belum masuk divisi Packing
    //                 ->orWhere(function ($query) {
    //                     $query->whereHas('divisi_outputs', function ($query) {
    //                         $query->where('division_id', 10); // Divisi Packing
    //                     });
    //                 })
    //                 // ->havingRaw('progress < 100');
    //                 ->where(function ($query) { // Misalnya progress dihitung sebagai persentase dari field tertentu

    //                 });
    //             });
    //     });
    // }

    public function scopeDashboardFilter($query)
    {
        return $query->where(function ($query) {
            $query->where('is_completed', false)
                ->where(function ($query) {
                    $query->whereHas('divisi_outputs', function ($query) {
                        $query->where('division_id', 10); // Divisi Packing
                    }, '=', 0) // Belum masuk divisi Packing
                    ->orWhere(function ($query) {
                        $query->whereHas('divisi_outputs', function ($query) {
                            $query->where('division_id', 10); // Divisi Packing
                        });
                    });
                });
        });
    }


}
