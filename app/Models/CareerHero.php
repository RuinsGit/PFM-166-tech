<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHero extends Model
{
    protected $fillable = [
        'image', 
        'image_alt_az', 
        'image_alt_en', 
        'image_alt_ru', 
        'description_az', 
        'description_en', 
        'description_ru', 
        'video', 
    ];
    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }
    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }
} 