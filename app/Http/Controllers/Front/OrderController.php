<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function showOrder()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('front.user.myorder', compact('orders'));
    }
    public function detailsOrder()
    {
        // $orders = Order::where('user_id', Auth::id())->get();
        return view('front.user.orderdetails', /* compact('orders') */);
    }
}
