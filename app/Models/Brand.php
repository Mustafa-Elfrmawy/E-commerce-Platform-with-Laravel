<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'sub_category_id',
        'name',
        'showhome',
        'slug',
        'status',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class , 'sub_category_id');
    }
}
