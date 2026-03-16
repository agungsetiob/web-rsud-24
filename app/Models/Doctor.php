<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    protected $fillable = [
        'name',
        'specialization',
        'photo',
        'category',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/doctor/' . $this->photo) : null;
    }
}
