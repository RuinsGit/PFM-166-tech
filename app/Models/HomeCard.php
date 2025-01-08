<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCard extends Model
{
    protected $fillable = [
        'image',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru',
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru'
    ];
}