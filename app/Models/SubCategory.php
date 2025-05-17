<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'showhome',
        'slug',
        'status',
   ];

       public function category()
   {
       return $this->hasMany(SubCategory::class, 'sub_category_id');
   }

 

   public function brand()
   {
       return $this->hasMany(Brand::class, 'sub_category_id');
   }
}
