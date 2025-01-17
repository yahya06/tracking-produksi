<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sizeUnit extends Model
{
    protected $fillable = ['name'];


    // public function sizes() {
    //     return $this->hasMany(size::class, 'unit_size_id');
    // }

    public function products() {
        return $this->belongsToMany(product::class, 'sizes')
                    ->withPivot('qty')
                    ->withTimestamps();
    }
}
