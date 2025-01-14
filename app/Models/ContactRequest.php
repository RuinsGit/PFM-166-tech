<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'name',
        'email',
        'number',
        'description',
        'status'
    ];

    const STATUS_NEW = 'Yeni';
    const STATUS_VIEWED = 'Baxıldı';

    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Yeni',
            self::STATUS_VIEWED => 'Baxıldı'
        ];
    }
} 