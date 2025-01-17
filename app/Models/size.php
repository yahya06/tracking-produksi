<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class size extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_unit_id',
        'qty'
    ];

    public function products() {
        return $this->belongsTo(product::class, 'product_id');
    }

    public function size_units() {
        return $this->belongsTo(sizeUnit::class, 'size_unit_id');
    }
}
