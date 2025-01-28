<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogType extends Model
{
    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'status'
    ];
    public function getTitleAttribute()
    {
        return $this->getAttribute('title_' . app()->getLocale());
    }


    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
} 