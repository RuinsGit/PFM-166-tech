<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'text_az',
        'text_en',
        'text_ru',
        'image',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru'
    ];

    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }

    public function getTextAttribute()
    {
        return $this->{'text_' . app()->getLocale()};
    }

    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }
}
