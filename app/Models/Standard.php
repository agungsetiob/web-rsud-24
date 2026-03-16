<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = [
        'name',
        'service_name',
        'file',
        'user_id',
    ];

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/sp/' . $this->file) : null;
    }
}
