<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'image',
        'position_az',
        'position_en',
        'position_ru',
        'status'
    ];
} 