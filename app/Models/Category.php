<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_id',
        'name',
        'sub_category_id',
        'showhome',
        'slug',
        'status',
    ];

    public function image()
    {
        return $this->belongsTo(ImageCategory::class, 'image_id');
    }

   public function category()
   {
       return $this->belongsTo(Category::class , 'category_id');
   }

}
