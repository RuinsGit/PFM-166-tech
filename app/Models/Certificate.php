<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title_az',
        'title_en',
        'title_ru',
        'pdf',
        'created_at'
    ];
}
