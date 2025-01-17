<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class division extends Model
{
    protected $fillable = ['name'];

    public function divisi_outputs() {
        return $this->hasMany(divisionOutput::class, 'division_id');
    }
}
