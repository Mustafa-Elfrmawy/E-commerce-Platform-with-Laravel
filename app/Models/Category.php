<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_id',
        'name',
        'slug',
        'status',
    ];

    public function image()
    {
        return $this->belongsTo(ImageCategory::class, 'image_id');
    }

    public function subCategory()
   {
       return $this->hasMany(SubCategory::class, 'category_id');
   }

}
