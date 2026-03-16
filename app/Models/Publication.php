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

    protected $appends = ['image_url', 'file_url'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
}
