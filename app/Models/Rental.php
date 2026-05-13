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

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeRented($query)
    {
        return $query->where('status', 'rented');
    }

    public function getMainImageAttribute()
    {
        return $this->images ? $this->images[0] : null;
    }

    public function getFormattedPriceMonthlyAttribute()
    {
        return $this->price_monthly ? 'Rp ' . number_format($this->price_monthly, 0, ',', '.') : '-';
    }

    public function getFormattedPriceYearlyAttribute()
    {
        return $this->price_yearly ? 'Rp ' . number_format($this->price_yearly, 0, ',', '.') : '-';
    }
}
