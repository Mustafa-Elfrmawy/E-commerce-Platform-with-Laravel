<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'showhome',
        'slug',
        'status',
    ];

    public function Category()
    {
        return $this->belongsTo(Brand::class , 'category_id');
    }
}
