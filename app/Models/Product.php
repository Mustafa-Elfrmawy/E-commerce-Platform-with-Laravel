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
        'category_id',
        'image_id',
        'sub_category_id',
        'brand_id',
    ];
}
