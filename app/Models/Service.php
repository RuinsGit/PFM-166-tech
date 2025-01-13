<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'image',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru',
        'bottom_image',
        'bottom_image_alt_az',
        'bottom_image_alt_en',
        'bottom_image_alt_ru',
        'meta_title_az',
        'meta_title_en',
        'meta_title_ru',
        'meta_description_az',
        'meta_description_en',
        'meta_description_ru',
        'title1_az',
        'title1_en',
        'title1_ru',
        'text1_az',
        'text1_en',
        'text1_ru',
        'title2_az',
        'title2_en',
        'title2_ru',
        'text2_az',
        'text2_en',
        'text2_ru'
    ];
} 