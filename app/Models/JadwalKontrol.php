<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKontrol extends Model
{
    use HasFactory;
    protected $connection = 'mysql_mr';
    protected $table = 'jadwal_kontrol';
    protected $primaryKey = 'ID';

    public $timestamps = false;
    protected $fillable = [
        'SUDAH_DIGUNAKAN',

    ];
}
