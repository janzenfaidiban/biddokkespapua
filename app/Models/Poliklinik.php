<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poliklinik extends Model
{
    use HasFactory, SoftDeletes;

    // protected $dates = ['deleted_at'];

    protected $fillable = [
        'nama_poliklinik',
        'alamat',
        'nama_kepala',
        'no_telp',
        'email',
        'password',
    ];
}
