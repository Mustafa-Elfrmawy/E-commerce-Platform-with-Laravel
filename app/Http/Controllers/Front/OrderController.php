<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Models\Product;
use App\Models\WishList;
use App\Models\DiscountUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function wishlist()
    {
        $wishLists = WishList::where('user_id', Auth::id())->get();

        return view('front.user.wishlist', compact('wishLists'));
    }

    public function wishListStore(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id'
        ]);

        $checkWishList = WishList::where('product_id', $request->product_id)
            ->where('user_id', Auth::guard('user')->user()->id)
            ->first();

            if ($checkWishList) {
                $checkWishList->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Product removed from wishlist.'
                ]);
            }

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Error while adding to wishList.',
                'errors' => $validated->errors()
            ]);
        }


        WishList::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::guard('user')->user()->id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'add wishList successfully.'
        ]);
    }

    public function deleteWishList(Request $request): JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'product_id' => 'required|exists:wish_lists,product_id'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid product_id.',
                'errors' => $validated->errors()
            ]);
        }

        $checkWishList = WishList::where('product_id', $request->product_id)
            ->where('user_id', Auth::guard('user')->user()->id)
            ->first();

        if (!$checkWishList) {
            return response()->json([
                'status' => false,
                'message' => 'Error while deleting wishList.'
            ]);
        }
        $checkWishList->delete();
        return response()->json([
            'status' => true,
            'message' => 'WishList deleted successfully.'
        ]);
    }
}
