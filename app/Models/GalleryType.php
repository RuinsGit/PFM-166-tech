<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryType extends Model
{
    protected $fillable = [
        'title_az', 
        'title_en', 
        'title_ru', 
        'status', 
    ];
} 