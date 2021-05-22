<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Constellation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type',
        'updated_date'
    ];
}
