<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacationHero extends Model
{
    protected $fillable = [
        'image', 
        'image_alt_az', 
        'image_alt_en', 
        'image_alt_ru', 
    ];
} 