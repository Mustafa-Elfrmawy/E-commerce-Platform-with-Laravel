<?php

namespace App\Http\Controllers\Helper;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HelperController extends Controller
{
    public function storeAssistant(Request $request, string $status)
    {
        if ($status === 'category') {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showhome = $request->show_home;
            $category->image_id = $request->image;
            $category->save();
            $request->session()->flash('success', 'Category created successfully');
            return  response()->json([
                'status' => true,
                'errors' => null
            ]);
        } elseif ($status === 'subcategory') {
            $sub_category = new SubCategory();
            $sub_category->name = $request->name;
            $sub_category->slug = $request->slug;
            $sub_category->status = $request->status;
            $sub_category->showhome = $request->show_home;
            $sub_category->category_id = $request->category_id;
            $sub_category->save();
            $request->session()->flash('success', 'SubCategory created successfully');
            return  response()->json([
                'status' => true,
                'errors' => null
            ]);
        }
    }







    public function ruleValidate(Request $request, string $status)
    {
        $rulesMap = [
            'store' => [
                'name'         => 'required|string|unique:categories,name',
                'slug'         => 'required|unique:categories,slug',
                'image'        => 'nullable|unique:categories,image_id|exists:image_categories,id',
                'status'       => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
            ],
            'update' => [
                'name'   => 'required|string|unique:categories,name,' . $request->input('id'),
                'slug'   => 'required|string|unique:categories,slug,' . $request->input('id'),
                'status' => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
            ],
            'storeSubCategory'   => [
                'name'         => 'required|string|unique:sub_categories,name',
                'slug'         => 'required|unique:sub_categories,slug',
                'category_id'  => 'required|integer|exists:categories,id',
                'status'       => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
            ],
            'updateSubCategory'  => [
                'name'         => 'required|string|unique:sub_categories,name,' . $request->input('id'),
                'slug'         => 'required|unique:sub_categories,slug,' .        $request->input('id'),
                'category_id'  => 'required|integer|exists:categories,id',
                'status'       => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
            ],
            'storeBrand' => [
                'name'            => 'required|string|unique:brands,name',
                'slug'            => 'required|unique:brands,slug',
                'sub_category_id' => 'required|integer|exists:sub_categories,id',
                'status'          => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
            ],
            'storeProduct' => [
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:products,slug',
                'sku' => 'required|string|max:100|unique:products,sku',
                'barcode' => 'required|unique:products,barcode|numeric|digits_between:8,20',
                'image' => 'nullable|array',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0|max:9999999999.99',
                'compare_price' => 'nullable|numeric|min:0',
                'track_qty' => 'required|in:no,yes',
                'qty' => 'required|numeric|min:0',
                'status' => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
                'is_featured' => 'required|in:yes,no',
                'category' => 'required|exists:categories,id',
                'sub_category' => 'required|exists:sub_categories,id',
                'brand' => 'required|exists:brands,id',
            ],
            'updateProduct' => [
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:products,slug,' . $request->input('id'),
                'sku' => 'required|string|max:100|unique:products,sku,' .   $request->input('id'),
                'barcode' => 'required|numeric|digits_between:8,20|unique:products,barcode,' . $request->input('id'),
                'image' => 'nullable|array',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'compare_price' => 'nullable|numeric|min:0',
                'track_qty' => 'required|in:no,yes',
                'qty' => 'required|numeric|min:0',
                'status' => 'required|in:0,1',
                'show_home'       => 'required|in:yes,no',
                'is_featured' => 'required|in:yes,no',
                'category' => 'required|exists:categories,id',
                'sub_category' => 'required|exists:sub_categories,id',
                'brand' => 'required|exists:brands,id',
            ],

        ];

        if (!isset($rulesMap[$status])) {
            throw new \InvalidArgumentException("Invalid validation status: {$status}");
        }

        return Validator::make($request->all(), $rulesMap[$status]);
    }







    public function finishUpdate(Request $request, object | null  $category, string $status, string $route)
    {
        if (($request->name != $category->name) && ($request->slug != $category->slug)) {

            $validate = $this->ruleValidate($request, $status);

            if ($validate->fails()) {
                return redirect()->route($route)->with('error', 'the name or slug has already been taken');
            }

            $category->name = $request->name;
            $category->slug = $request->slug;
        }

        if ($route == 'admin.sub-category.list') {
            $category->category_id = $request->category_id;
        }

        $category->status = $request->status;
        $category->showhome = $request->show_home;
        $category->save();
        return redirect()->route($route)->with('success', 'Category updated');
    }
}
