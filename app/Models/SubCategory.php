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
        'category_id',
   ];

   public function category()
   {
       return $this->belongsTo(Category::class , 'category_id');
   }

   public function brand()
   {
       return $this->hasMany(Brand::class, 'sub_category_id');
   }
}
