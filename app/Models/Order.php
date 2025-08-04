<?php

namespace App\Models;

use App\Models\User;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'user_id',
        'product_id',
        'country_id',
        'address',
        'city',
        'state',
        'zip',
        'apartment',
        'quantity'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
