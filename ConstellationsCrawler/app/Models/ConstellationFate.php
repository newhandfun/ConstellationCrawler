<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConstellationFate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'constellation_type',
        'type',
        'score',
        'introduction',
        'created_date'
    ];
}
