<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ScheduleDay extends Model
{
    protected $fillable = ['date'];

    public function getDayAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('l');
    }
}
