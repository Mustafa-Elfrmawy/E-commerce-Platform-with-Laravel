<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountUser extends Model
{
    //
    protected $fillable = [
        'user_id',
        'total_discount',
    ];
    public function discountUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
