<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'nama_dokumen',
        'slug',
        'produsen_data',
        'rencana_rilis',
        'tanggal_rilis',
        'deskripsi',
        'image',
        'file',
    ];

    protected $dates = [
        'rencana_rilis',
        'tanggal_rilis',
    ];
}
