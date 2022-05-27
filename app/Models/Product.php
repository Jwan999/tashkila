<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::Class)->select(['id', 'name', 'overview', 'logo', 'percentage']);
    }

    public function getFinalPriceAttribute()
    {
        $percentage = $this->shop->percentage;
        $addedPrice = $percentage * $this->price / 100;
        return ceil($addedPrice + $this->price);
    }

    protected $appends = ['final_price'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->user_id = auth()->user()->id;
        });
    }
}
