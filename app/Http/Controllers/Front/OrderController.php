<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountUser;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function showOrder()
    {
        $products_id = [];
        $orders = Order::where('user_id', Auth::id())->get();
        return view('front.user.myorder', compact('orders'));
    }
    public function detailsOrder(string $idOrder)
    {
        $order = Order::find($idOrder);
        $discount_user = DiscountUser::where('user_id', Auth::id())->first();


        if (!$order):
            return redirect()->back()->with('errorFindProduct', "sorry we cant find product");
        endif;

        preg_match_all('/(\d+)x(\d+)/', $order->product_id, $matches);

        $products_id = $matches[1];
        $products = Product::whereIn('id', $products_id)->get();
        $quantity = $matches[2];


        return view('front.user.orderdetails', compact('order', 'products', 'quantity',  'discount_user'));
    }
}
