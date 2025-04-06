<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Golongandarah extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];

    public function anggotakeluarga()
    {
        return $this->belongsTo(Anggotakeluarga::class, 'id');
    }
}
