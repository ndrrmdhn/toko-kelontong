<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_monthly',
        'price_yearly',
        'facilities',
        'images',
        'status',
        'whatsapp_message'
    ];

    protected $casts = [
        'price_monthly' => 'decimal:2',
        'price_yearly' => 'decimal:2',
        'facilities' => 'array',
        'images' => 'array',
    ];
}
