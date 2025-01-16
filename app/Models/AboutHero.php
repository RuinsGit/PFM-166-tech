<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutHero extends Model
{
    protected $fillable = [
        'image',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru',
        'description1_az',
        'description1_en',
        'description1_ru',
        'description2_az',
        'description2_en',
        'description2_ru'
    ];
    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }

    public function getDescription1Attribute()
    {
        return $this->{'description1_' . app()->getLocale()};
    }
    public function getDescription2Attribute()
    {
        return $this->{'description2_' . app()->getLocale()};
    }

} 