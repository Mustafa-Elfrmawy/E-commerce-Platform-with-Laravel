<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $orders  = Order::where('user_id', Auth::id())->get();
        $carts  = Cart::where('user_id', Auth::id())->get();
        $countries  = Country::all();

        return view('front.user.checkout', compact('orders' , 'countries' , 'carts'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'required|string|max:20',
            'user_id'     => 'required|exists:users,id',
            'product_id'  => 'required|exists:products,id',
            'country_id'  => 'required|exists:countries,id',
            'city'        => 'required|string|max:255',
            'address'        => 'required|string|max:355',
            'state'       => 'required|string|max:255',
            'zip'         => 'required|string|max:20',
            'apartment'         => 'nullable|string|max:200',
            'notes_order'         => 'nullable|string|max:300',
            // 'quantity'    => 'nullable|integer|min:1',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
