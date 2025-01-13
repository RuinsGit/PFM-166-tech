<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioType extends Model
{
    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'status',
    ];
} 