<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $connection = 'mysql_mr';
    protected $table = 'reservasi';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['STATUS', 'JENIS_APLIKASI'];
}