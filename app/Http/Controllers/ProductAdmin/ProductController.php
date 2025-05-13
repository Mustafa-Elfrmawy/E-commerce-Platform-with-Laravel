<?php

namespace App\Http\Controllers\ProductAdmin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helper\HelperController;
use PHPUnit\Framework\ComparisonMethodDoesNotAcceptParameterTypeException;

class ProductController extends Controller
{

    private $helper;
    private $helperImage;

    public function __construct()
    {
        $this->helper = new HelperController();
        $this->helperImage = new UploadImage();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::latest();
        if ($request->get('keyword') != null) {
            $products = $products->where('title', 'LIKE', '%' . $request->get('keyword') . '%');
        }
        $products = $products->paginate(20);
        $images = Product::whereIn('id', [$products])->get();
        return view('admin.product.list', compact('products'));
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
        $images_id = null;
        $data_images = null;

    
        $validator = $this->helper->ruleValidate($request, 'storeProduct');

        if ($validator->fails()) {
            dd($request->image);
            return redirect()->route('admin.product.create')->withInput()
                ->withErrors($validator)
                ->with('errorImage', 'please upload your image again and check you error');
        }


        // dd($images_id);
            if ($request->image) {
            $images_id  = $this->helperImage->store($request);
            if (isset($images_id['Image_errors'])) {
                return redirect()->route('admin.product.create')->withInput()->withErrors($images_id['Image_errors']);
            }
        }
        if (is_array($images_id)) {
            foreach ($images_id as $id => $value):
                $data_images['id'][] = $value['id'];
                $data_images['image_name'][] = $value['image_name'];
            endforeach;
            session()->put('uploaded_images', $data_images['image_name']);
            $request->merge([
                'image_id' => implode(',', $data_images['id']),
            ]);
        } else {
            $request->merge([
                'image_id' => null,
            ]);
        }

        $request->merge([
            'track_qty' => $request->input('track_qty') == 'on' ? 'yes' : 'no'
        ]);

        $product_new = $this->newProduct($request);


        return ($product_new) ? redirect()->route('admin.product.list')
            ->with('success', 'created product success') :
            redirect()->route('admin.product.list')
            ->withErrors('error while created product');
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
    public function edit(string $product_id, Request $request)
    {
        //
        $product = Product::find($product_id);
        if (empty($product)) {
            return redirect()->route('admin.product.list')->withErrors('Product not found');
        }
        $images = ProductImage::whereIn('id', explode(',', $product->image_id))
            ->pluck('image_product', 'id');
        $sub_categories = SubCategory::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        return view('admin.product.edit', compact('product', 'sub_categories', 'brands', 'categories', 'images'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_id)
    {
        $product = Product::find($product_id);
        if (empty($product)) {
            return redirect()->route('admin.product.list')->withErrors('Product not found');
        }
        $request->merge([
            'track_qty' => $request->input('track_qty') == 'on' ? 'yes' : 'no'
        ]);

        $no_change =
            $product->title             ==        $request->input('title')   &&
            $product->slug              ==            $request->input('slug') &&
            $product->barcode           ==         $request->input('barcode') &&
            $product->sku               ==             $request->input('sku') &&
            // $product->image_id          ==        $request->input('image_id') &&
            $product->description       ==     $request->input('description') &&
            $product->price             ==           $request->input('price') &&
            $product->compare_price     ==   $request->input('compare_price') &&
            $product->track_qty         ==       $request->input('track_qty') &&
            $product->qty               ==             $request->input('qty') &&
            $product->status            ==          $request->input('status') &&
            $product->is_featured       ==     $request->input('is_featured') &&
            $product->category_id       ==     $request->input('category')   &&
            $product->sub_category_id   == $request->input('sub_category')   &&
            $product->brand_id          ==        $request->input('brand');



        if ($no_change) {
            return redirect()->route('admin.product.list')->with('warning', 'No changes detected');
        }
        $validator = $this->helper->ruleValidate($request, 'updateProduct');

        if ($validator->fails()) {
            return redirect()->route('admin.product.list')->withInput()->withErrors($validator);
        }
        $update = $this->updateAssistant($request);

        // dd($update);
        return ($update) ? redirect()->route('admin.product.list')
            ->with('success', 'updated product success') :
            redirect()->route('admin.product.list')
            ->withErrors('error while updated product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }



    protected function newProduct(Request $request)
    {
        $new_product = Product::create([
            'title' =>           $request->input('title'),
            'slug' =>            $request->input('slug'),
            'image_id' =>        $request->input('image_id'),
            'description' =>     $request->input('description'),
            'price' =>           $request->input('price'),
            'compare_price' =>   $request->input('compare_price'),
            'sku' =>             $request->input('sku'),
            'barcode' =>         $request->input('barcode'),
            'track_qty' =>       $request->input('track_qty'),
            'qty' =>             $request->input('qty'),
            'status' =>          $request->input('status'),
            'is_featured' =>     $request->input('is_featured'),
            'category_id' =>     $request->input('category'),
            'sub_category_id' => $request->input('sub_category'),
            'brand_id' =>        $request->input('brand'),
        ]);

        return $new_product;
    }

    public function updateAssistant(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->update([
            'title'           => $request->input('title'),
            'slug'            => $request->input('slug'),
            // 'image_id'      => $request->input('image_id'),
            'description'     => $request->input('description'),
            'price'           => $request->input('price'),
            'compare_price'   => $request->input('compare_price'),
            'sku'             => $request->input('sku'),
            'barcode'         => $request->input('barcode'),
            'track_qty'       => $request->input('track_qty'),
            'qty'             => $request->input('qty'),
            'status'          => $request->input('status'),
            'is_featured'     => $request->input('is_featured'),
            'category_id'     => $request->input('category'),
            'sub_category_id' => $request->input('sub_category'),
            'brand_id'        => $request->input('brand'),
        ]);

        return $product;
    }
}
