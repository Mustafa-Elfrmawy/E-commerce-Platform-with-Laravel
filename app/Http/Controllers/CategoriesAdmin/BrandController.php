<?php

namespace App\Http\Controllers\CategoriesAdmin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helper\HelperController;

class BrandController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new HelperController();    
    }
    
    
    public function create(): View
    {
        $sub_categories = SubCategory::pluck('name' , 'id');
        $categories = Category::pluck('name' , 'id');
        return view('admin.brand.create' , compact('sub_categories' , 'categories'));
    }
    
    public function index(Request $request): View
    {
        $brands = Brand::latest();
        if ($request->get('keyword') != null) {
            $brands = $brands->where('name', 'LIKE', '%' . $request->get('keyword') . '%');
        }
        $brands = $brands->paginate(10);

        return view('admin.brand.list', compact('brands'));
    }



    public function store(Request $request) {

        $validate = $this->helper->ruleValidate($request, 'storeBrand');
        if($validate->passes()) {

              Brand::create([
                'sub_category_id' => $request->input('sub_category_id'),
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'status' => $request->input('status'),
                'showhome' => $request->input('show_home'),
            ]);

            $request->session()->flash('success', 'Brand created successfully');

            return response()->json([
                'status' => true,
                'errors' => null,
            ]);

        } else{

            return response()->json([
                'status' => false,
                'errors' => $validate->errors(),
            ]);
        }


    }




    public function edit(string $brandId)
    {
        $brand = Brand::find($brandId);
        $sub_categories = SubCategory::pluck( 'name' , 'id'  );
        if (empty($brand)) {
            return redirect()->route('admin.category.list')->withError('Category not found');
        }
        return view('admin.brand.edit', compact('brand' , 'sub_categories'));
    }


    public function update(Request $request , $brandId) {
        $brand = Brand::find($brandId);
        $noChanges = 
        $request->name === $brand->name 
        && $request->slug === $brand->slug 
        && $request->status == $brand->status 
        &&  $request->sub_category_id == $brand->sub_category_id
        &&  $request->show_home == $brand->showhome;

        if ($noChanges) {
            return redirect()->route('admin.brand.list')->with('warning', 'No changes detected');
        }



        if($request->name != $brand->name  || $request->slug != $brand->slug ) {
            $validate = Validator::make( $request->all() ,[
                'name' => 'required|string|unique:brands,name,'.$brand->id,
                'slug' => 'required|unique:brands,slug,' .$brand->id, 
            ]);

            if($validate->passes()) {
            $brand->name = $request->name; 
            $brand->slug = $request->slug; 
        } else {
        return redirect()->route('admin.brand.list')->with('errors', $validate->errors());
        }

        }


        
        if($request->status != $brand->status ||  $request->sub_category_id != $brand->sub_category_id || $request->show_home != $brand->showhome ) {
            $validate = Validator::make( $request->all() ,[
                'sub_category_id' => 'required|integer|exists:sub_categories,id',
                'status' => 'required|in:0,1',
                'show_home' => 'required|in:yes,no'
            ]);

            if($validate->passes()) {
                $brand->status = $request->status; 
                $brand->showhome = $request->show_home; 
                $brand->sub_category_id = $request->sub_category_id; 
            } else {
            return redirect()->route('admin.brand.list')->with('errors', $validate->errors());
        }

        }


    $brand->save();
    return redirect()->route('admin.brand.list')->with('success', 'brand updated detected');
}


public function destroy(Request $request ,   string $brand_id) {
    $brand = Brand::find($brand_id);
    if(empty($brand)) {
        $request->session()->flash('warning', 'Brand not found');
        return response()->json([
            'status' => true,
            'message' => 'category not found',
        ]);
    }

    $brand->delete();
    $request->session()->flash('success', 'Brand deleted success');
    return response()->json([
        'status' => true,
        'message' => 'category not found',
    ]);
}





}