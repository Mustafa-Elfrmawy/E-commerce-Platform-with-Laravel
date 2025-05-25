<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::where('showhome' , 'yes')->where('status' , 1)->latest()->get();
        // $sub_categories = SubCategory::where('showhome' , 'yes')->where('status' , 1)->latest()->get();
        // $products = Product::where('showhome' , 'yes')->where('is_featured' , 'yes')->where('status' , 1)->latest()->get();
        // $products_latest = Product::where('showhome' , 'yes')->where('is_featured' , 'no')->where('status' , 1)->latest()->get();
        return view('front.home'  /* compact('categories' , 'sub_categories' , 'products' , 'products_latest' )  */);
    }
    public function indexProduct(string $id)
    {
        $product = Product::find($id);
        if ( empty($product) || $product->status != 1) {
            return redirect()->route('front.home')->with('error', 'Product not found or inactive.');
        }
        $products_related = Product::where('status', 1)
            ->where('showhome', 'yes')
            ->where('id', '!=' , $product->id)
            ->where('category_id', $product->category_id)
            ->get();
            $images = explode( ',' , $product->image_id);
        $images = ProductImage::whereIn('id', $images)->get();
        return view('front.product', compact('product', 'products_related' , 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function shop()
    {
        return view('front.shop');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
