<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class Frontntroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('showhome' , 'yes')->where('status' , 1)->latest()->get();
        $sub_categories = SubCategory::where('showhome' , 'yes')->where('status' , 1)->latest()->get();
        $products = Product::where('showhome' , 'yes')->where('is_featured' , 'yes')->where('status' , 1)->latest()->get();
        $products_latest = Product::where('showhome' , 'yes')->where('is_featured' , 'no')->where('status' , 1)->latest()->get();
        return view('front.home' , compact('categories' , 'sub_categories' , 'products' , 'products_latest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
