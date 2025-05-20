<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_category_id',
        'name',
        'sub_category_id',
        'showhome',
        'slug',
        'status',
    ];

    public function image()
    {
        return $this->belongsTo(ImageCategory::class, 'image_category_id');
    }

   public function subCategory()
   {
       return $this->belongsTo(SubCategory::class , 'sub_category_id');
   }


}
