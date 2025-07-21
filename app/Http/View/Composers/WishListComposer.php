<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\WishList;

class WishListComposer
{
          public function compose(View $view)
          {
                    $wishList = [];

                    if (Auth::guard('user')->check()) {
                              $wishList = WishList::where('user_id', Auth::guard('user')->id())
                                        ->pluck('product_id')
                                        ->toArray();
                    }

                    $view->with('wishList', $wishList);
          }
}
