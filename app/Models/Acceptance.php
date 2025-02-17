<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Acceptance extends Model
{
    protected $fillable = [
        'title_az', 
        'title_en', 
        'title_ru', 
        'text_az', 
        'text_en', 
        'text_ru', 
    ];

    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }

    public function getTextAttribute()
    {
        return $this->{'text_' . app()->getLocale()};
    }
}
