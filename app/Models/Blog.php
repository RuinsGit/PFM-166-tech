<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'main_image',
        'main_image_alt_az',
        'main_image_alt_en',
        'main_image_alt_ru',
        'text_az',
        'text_en',
        'text_ru',
        'description_1_az',
        'description_1_en',
        'description_1_ru',
        'description_2_az',
        'description_2_en',
        'description_2_ru',
        'bottom_images',
        'bottom_images_alt_az',
        'bottom_images_alt_en',
        'bottom_images_alt_ru',
        'meta_title_az',
        'meta_title_en',
        'meta_title_ru',
        'meta_description_az',
        'meta_description_en',
        'meta_description_ru'
    ];
}
