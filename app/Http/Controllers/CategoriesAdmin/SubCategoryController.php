<?php

namespace App\Http\Controllers\CategoriesAdmin;


use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController;
use Illuminate\View\View;

class SubCategoryController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new HelperController();
    }


    public function index(Request $request): View
    {
        $sub_categories = SubCategory::latest();

        if ($request->get('keyword') != null) {
            $sub_categories = $sub_categories->where('name', 'LIKE', '%' . $request->get('keyword') . '%');
        }
        $sub_categories = $sub_categories->paginate(10);

        return view('admin.subcategory.list', compact('sub_categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }




    public function store(Request $request)
    {
        $validate = $this->helper->ruleValidate($request, 'storeSubCategory');


        if ($validate->passes()) {
            return $this->helper->storeAssistant($request, 'subcategory');
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
    }

    public function edit(string $sub_categoryId)
    {
        $sub_categories = SubCategory::find($sub_categoryId);
        $categories = Category::orderBy('id', 'DESC')->pluck('name', 'id');


        if (empty($sub_categories)) {
            return redirect()->route('admin.sub-category.list')->withError('Category not found');
        }
        
        return view('admin.subcategory.edit', compact('sub_categories' , 'categories'));
    }





    public function update(Request $request, string $id)
    {
        $sub_category = SubCategory::find($id);
        /* comparison data */
        if (!$sub_category) {
            return redirect()->route('admin.sub-category.list')->with('error', 'Category not found');
        }

        $noChanges = $request->name === $sub_category->name
        && $request->slug === $sub_category->slug
        && $request->status == $sub_category->status 
        && $request->category_id == $sub_category->category_id  
        && $request->show_home == $sub_category->showhome; 

        if ($noChanges) {
            return redirect()->route('admin.sub-category.list')->with('warning', 'No changes detected');
        }
     


        return $this->helper->finishUpdate($request, $sub_category , 'updateSubCategory' ,  'admin.sub-category.list');
    }



    public function destroy(string $id, Request $request)
    {
        $sub_category = SubCategory::find($id);
        
        if (empty($sub_category)) {
            $request->session()->flash('warning', 'category not found');
            return response()->json([
                'status' => true,
                'message' => 'category not found',
            ]);
        }

        $sub_category->delete();
        $request->session()->flash('success', 'delete success');
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ]);

    }
}
