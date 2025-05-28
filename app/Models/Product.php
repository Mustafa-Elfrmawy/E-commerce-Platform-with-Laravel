<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'compare_price',
        'sku',
        'showhome',
        'barcode',
        'track_qty',
        'qty',
        'status',
        'is_featured',
        'category_id',
        'image_id',
        'sub_category_id',
        'brand_id',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
