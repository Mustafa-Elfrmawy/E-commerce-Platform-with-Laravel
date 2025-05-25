<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function cart()
    {
        return view('front.cart');
    }
    public function addToCart(string $id)
    {
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cart) {
            return response()->json([
                'status' => false,
                'message' => 'Item with is already in the cart. name:'
            ]);
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'quantity' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item with has been added to the cart.name:'
        ]);
    }
}
