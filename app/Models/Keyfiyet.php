<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyfiyet extends Model
{
    protected $fillable = [
        'number_filial',
        'number_customer',
        'number_keyfiyet',
        'filial_title_az',
        'filial_title_en',
        'filial_title_ru',
        'customer_title_az',
        'customer_title_en',
        'customer_title_ru',
        'keyfiyet_title_az',
        'keyfiyet_title_en',
        'keyfiyet_title_ru',
    ];

    public function getFilialTitleAttribute()
    {
        return $this->{'filial_title_' . app()->getLocale()};
    }

    public function getCustomerTitleAttribute()
    {
        return $this->{'customer_title_' . app()->getLocale()};
    }

    public function getKeyfiyetTitleAttribute()
    {
        return $this->{'keyfiyet_title_' . app()->getLocale()};
    }   
}
