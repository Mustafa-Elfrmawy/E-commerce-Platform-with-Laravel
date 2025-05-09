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
            $sub_category->category_id = $request->category_id;
            $sub_category->save();
            $request->session()->flash('success', 'SubCategory created successfully');
            return  response()->json([
                'status' => true,
                'errors' => null
            ]);
        }
    }







    public function validateCategory(Request $request, string $status)
    {
        if ($status == 'store') {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
                'slug' => 'required|unique:categories,slug',
                'image' => 'nullable|unique:categories,image_id|exists:image_categories,id',
                'status' => 'required|in:0,1'
            ]);
        } elseif($status == 'update') {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|unique:categories,name',
                'slug' => 'required|string|unique:categories,slug',
                'status' => 'required|in:0,1'
            ]);
        } elseif( $status == 'storeSubCategory' || $status == 'updateSubCategory' ) {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|unique:sub_categories,name',
                'slug' => 'required|unique:sub_categories,slug',
                'category_id' => 'required|integer|exists:categories,id',
                'status' => 'required|in:0,1'
            ]);
        } elseif($status == 'storeBrand') {
            $validate = Validator::make($request->all(), [
                'name' => 'required|string|unique:brands,name',
                'slug' => 'required|unique:brands,slug',
                'sub_category_id' => 'required|integer|exists:sub_categories,id',
                'status' => 'required|in:0,1'
            ]);
        }
        return $validate;
    }






    public function finishUpdate(Request $request , object | null  $category , string $status , string $route)
    {
        if (($request->name != $category->name) && ($request->slug != $category->slug)) {

            $validate = $this->validateCategory($request, $status);

            if ($validate->fails()) {
                return redirect()->route($route)->with('error', 'the name or slug has already been taken');
            }

            $category->name = $request->name;
            $category->slug = $request->slug;
        }
        
        if($route == 'admin.sub-category.list') {
            $category->category_id = $request->category_id;
        }

        $category->status = $request->status;
        $category->save();
        return redirect()->route($route)->with('success', 'Category updated');
    }
}
