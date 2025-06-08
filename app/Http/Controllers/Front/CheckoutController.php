<?php

namespace App\Http\Controllers\Front;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\DiscountCode;
use App\Models\DiscountUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{

    public function checkout()
    {
        // $orders  = Order::where('user_id', Auth::id())->get();
        $discountUser = DB::table('discount_users')
            ->where('user_id', Auth::id())
            ->first();
        $discountUser = empty($discountUser) ? false : $discountUser;
        $carts  = Cart::where('user_id', Auth::id())->get();
        $countries  = Country::all();

        return view('front.user.checkout', compact('countries', 'carts', 'discountUser'));
    }

    public function store(Request $request)
    {
        $total = \App\Models\Cart::where('user_id', Auth::id())->sum('total_price');
        $discount_user = DiscountUser::where('user_id', Auth::id())->first();

        if ($discount_user->total_discount) :
            $request->merge([
                'total' => $discount_user->total_discount
            ]);
        else :
            $request->merge([
                'total' => $total
            ]);
        endif;
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'required|string|max:20',
            'country'  => 'required|exists:countries,id',
            'city'        => 'required|string|max:255',
            'address'        => 'required|string|max:355',
            'state'       => 'required|string|max:255',
            'zip'         => 'required|string|max:20',
            'apartment'         => 'nullable|string|max:200',
            'notes_order'         => 'nullable|string|max:300',
            'total'         => 'required|numeric',
            // 'quantity'    => 'nullable|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        return $this->finishStore($request);
    }

    protected function finishStore(Request $request)
    {

        $arr_format = $this->assistantFinishStoreOrder();
        $order = new Order();
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->user_id = Auth::id();
        $order->product_id = $arr_format;
        $order->country_id = $request->country;
        $order->city = $request->city;
        $order->address = $request->address;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->apartment = $request->apartment;
        $order->notes_order = $request->notes_order;
        $order->sub_total = $request->total;
        $order->save();
        $this->deleteCartAndDiscountUser();


        return ($order) ? redirect()->route('front.home')
            ->with('successOrder', 'create order success') :
            redirect()->route('front.home')
            ->with('errorOrder', 'error while create order');
    }



    function applyCoupon(Request $request)
    {
        $discountUser = DB::table('discount_users')
            ->where('user_id', Auth::id())
            ->first();
        if ($discountUser) :
            return response()->json([
                'status' => false,
                'message' => 'please use the last discount and add coupon again.'
            ]);
        endif;
        $code = $request->input('coupon_code');
        $total = \App\Models\Cart::where('user_id', Auth::id())->sum('total_price');
        // $total_price = $total;
        if (!$total) :
            return response()->json([
                'status' => false,
                'message' => 'error while search your product.'
            ]);
        endif;

        $discount = DiscountCode::where('code', $code)
            ->where('active', true)
            ->first();

        if (!$discount) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or inactive coupon code.'
            ]);
        }

        $now = now();


        if ($discount->start_date && $now->lt($discount->start_date)) {
            return response()->json([
                'status' => false,
                'message' => 'This coupon is not valid yet.'
            ]);
        }

        if ($discount->expiry_date && $now->gt($discount->expiry_date)) {
            return response()->json([
                'status' => false,
                'message' => 'This coupon has expired.'
            ]);
        }


        if ($discount->max_uses !== null && $discount->used_count >= $discount->max_uses) {
            return response()->json([
                'status' => false,
                'message' => 'This coupon has reached its usage limit.'
            ]);
        }


        // $orderAmount = $request->input('order_amount', 0);
        // if ($orderAmount < $discount->min_order_amount) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'The minimum order amount for this coupon is ' . $discount->min_order_amount
        //     ]);
        // }


        $discount->increment('used_count');
        DB::table('discount_users')->insert([
            'total_discount' => round($total - ($total * $discount->value / 100), 2),
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Coupon applied successfully! You got a discount of' . $discount->value . '%',
            'discount' => round($total - ($total * $discount->value / 100), 2),
            // 'type' => $discount->type,
        ]);
    }

    protected function assistantFinishStoreOrder()
    {
        $arr_format = [];
        $arr_products = Cart::where('user_id', Auth::id())->pluck('quantity', 'product_id')->toArray();
        foreach ($arr_products as $key => $value) {
            $arr_format[] = $key . 'x' . $value;
        }
        return  $arr_format = implode(',', $arr_format);
    }

    protected function deleteCartAndDiscountUser()
    {
        Cart::where('user_id', Auth::id())->delete();
        DB::table('discount_users')
            ->where('user_id', Auth::id())
            ->delete();
    }
}
