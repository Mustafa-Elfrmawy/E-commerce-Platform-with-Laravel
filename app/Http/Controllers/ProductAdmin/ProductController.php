<?php

namespace App\Http\Controllers\ProductAdmin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sub_categories = SubCategory::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view('admin.product.create', compact('sub_categories', 'brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request->all());
        $request->merge([
            'track_qut' => $request->input('track_qut') == 'on' ? 'on' : 'off'
        ]);

        $validator = $this->validated($request);

        if ($validator->fails()) {

            return redirect()->route('admin.product.list')->withInput()->withErrors($validator);
        }
    
        $product_new = $this->newProduct($request);
   

        return ($product_new)? redirect()->route('admin.product.list')->with( 'success' , 'created product success' ): redirect()->route('admin.product.list')->withInput()->withErrors( 'error while created product' );
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }



    protected function newProduct(Request $request) {
         $new_product = Product::create([
            'title' =>        $request->input('title'),
            'slug' =>            $request->input('slug'),
            'description' =>     $request->input('description'),
            'price' =>           $request->input('price'),
            'compare_price' =>   $request->input('compare_price'),
            'sku' =>             $request->input('sku'),
            'barcode' =>         $request->input('barcode'),
            'track_qut' =>       $request->input('track_qut'),
            'qty' =>             $request->input('qty'),
            'status' =>          $request->input('status'),
            'is_featured' =>     $request->input('is_featured'),
            'category_id' =>     $request->input('category'),
            'sub_category_id' => $request->input('sub_category'),
            'brand_id' =>        $request->input('brand'),
        ]);

        return $new_product;
    }

    protected function validated(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'sku' => 'required|string|max:100|unique:products,sku',
            'barcode' => 'required|numeric|digits_between:8,20',
            'track_qut' => 'required|in:on,off',
            'qut' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
            'is_featured' => 'required|in:yes,no',
            'category' => 'required|exists:categories,id',
            'sub_category' => 'required|exists:sub_categories,id',
            'brand' => 'required|exists:brands,id',
        ]);

        return $validator;
    }
}
