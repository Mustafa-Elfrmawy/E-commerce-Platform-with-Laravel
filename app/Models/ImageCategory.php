<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageCategory extends Model
{
   protected $fillable = [
        'name',
   ];
   
   public function categories()
   {
       return $this->hasMany(Category::class, 'image_category_id');
   }
}
