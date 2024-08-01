<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function matkul()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah');
    }
}