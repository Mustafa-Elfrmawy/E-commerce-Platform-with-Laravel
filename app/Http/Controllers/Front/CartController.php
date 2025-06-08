<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DiscountUser;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function cart()
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('front.cart', compact('carts'));
    }
    public function quantityCartIcon()
    {
        $count = \App\Models\Cart::where('user_id', Auth::id())->count();
        if (!$count) {
            return response()->json([
                'status' => true,
                'message' => 0
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => $count
        ]);
    }

    public function addToCart(string $id)
    {
        $discount_user = DiscountUser::where('user_id', Auth::id())->first();
        if ($discount_user) :
            return response()->json([
                'status' => "non",
                'message' => 'please Complete your transaction before add a new product because your discount is available'
            ]);
        endif;
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        $product = Product::find($id);
        if ($cart) {
            return response()->json([
                'status' => false,
                'message' => 'Item with is already in the cart. name:'
            ]);
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'total_price' => $product->price,
            'quantity' => 1
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Item with has been added to the cart.name:'
        ]);
    }

    public function plusQuantity(Request $request)
    {
        $checkQty = Product::find($request->product_id);
        $checkQtyCart = Cart::where('product_id', $request->product_id)->where('user_id', Auth::id())->first();


        if (!empty($checkQtyCart) && !empty($checkQty) && $checkQty->qty > $checkQtyCart->quantity) {

            $updated = DB::table('cart')
                ->where('product_id', $request->product_id)
                ->where('user_id', $request->user_id)
                ->increment('quantity');
            if ($updated) :
                $cart = DB::table('cart')
                    ->where('product_id', $request->product_id)
                    ->where('user_id', $request->user_id)
                    ->first();

                DB::table('cart')
                    ->where('product_id', $request->product_id)
                    ->where('user_id', $request->user_id)
                    ->update([
                        'total_price' => $cart->quantity * $checkQty->price,
                    ]);

                return response()->json([
                    'status' => true,
                    'new_quantity' => $cart->quantity,
                ]);
            endif;
        }

        return response()->json([
            'status' => false,
            'message' => 'Cart item not found.  or  We are out of stock the stock available' . $checkQty->qty
        ]);
    }

    public function minusQuantity(Request $request)
    {
        $checkQty = Product::find($request->product_id);

        $cart = DB::table('cart')
            ->where('product_id', $request->product_id)
            ->where('user_id', $request->user_id)
            ->first();

        if ($cart) {
            if ($cart->quantity > 1) {
                DB::table('cart')
                    ->where('product_id', $request->product_id)
                    ->where('user_id', $request->user_id)
                    ->decrement('quantity');

                $updatedCart = DB::table('cart')
                    ->where('product_id', $request->product_id)
                    ->where('user_id', $request->user_id)
                    ->first();

                DB::table('cart')
                    ->where('product_id', $request->product_id)
                    ->where('user_id', $request->user_id)
                    ->update([
                        'total_price' => $updatedCart->quantity * $checkQty->price,
                    ]);

                return response()->json([
                    'status' => true,
                    'new_quantity' => $updatedCart->quantity,

                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Minimum quantity reached.',
                    'new_quantity' => $cart->quantity,
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => 'Cart item not found.'
        ]);
    }

    public function deleteCart(Request $request)
    {
        $deleted = DB::table('cart')
            ->where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->delete();

        if ($deleted) {
            return response()->json([
                'status' => true,
                'message' => 'delete success.',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'product cart not found name: ' . $request->product_title,
        ]);
    }
}
