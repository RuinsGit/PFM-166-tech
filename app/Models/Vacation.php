<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    protected $fillable = [
        'title_az', 
        'title_en', 
        'title_ru', 
        'description_az', 
        'description_en', 
        'description_ru', 
        'email', 
        'email_text', 
        'application_deadline', 
        'view_count', 
    ];

    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }
}