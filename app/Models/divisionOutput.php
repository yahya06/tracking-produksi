<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisionOutput extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'product_id',
        'unit_size_id',
        'qty',
        'input_date'
    ];

    public function division()
    {
        return $this->belongsTo(division::class, 'division_id');
    }

    public function products()
    {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function unitSize()
    {
        return $this->belongsTo(sizeUnit::class, 'unit_size_id');
    }

    public function sizes()
    {
        return $this->belongsTo(size::class, 'size_id');
    }
}
