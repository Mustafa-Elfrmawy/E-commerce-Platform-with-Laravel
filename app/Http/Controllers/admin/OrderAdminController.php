<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\DiscountUser;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderAdminController extends Controller
{
    //
    public function index(Request $request): View
    {
        $orders = Order::latest();
        $discount_user = DiscountUser::where('user_id', Auth::id())->first();
        if ($request->get('keyword') != null) {
            $orders = $orders->where('first_name', 'LIKE', '%' . explode(' ', $request->get('keyword'))[0] . '%')
                ->where('last_name', 'LIKE', '%' . explode(' ', $request->get('keyword'))[1] ?? "" . '%');
        }
        $orders = $orders->paginate(10);

        return view('admin.order.list', compact('orders', 'discount_user'));
    }
    public function indexDetails(string $idOrder)
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
        return view('admin.order.details'  , compact('products'  , 'order', 'quantity' ,  'discount_user'));
    }
    





    public function discountCreate() {
        return view('admin.discount.create'  /* , compact('products'  , 'order', 'quantity' ,  'discount_user') */);

    }



    public function userCreate() {
        return view('admin.user.create'  /* , compact('products'  , 'order', 'quantity' ,  'discount_user') */);

    }

        public function userUser() {
        return view('admin.user.user'  /* , compact('products'  , 'order', 'quantity' ,  'discount_user') */);

    }
    

}
