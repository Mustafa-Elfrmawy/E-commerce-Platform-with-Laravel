<?php

namespace App\Http\Controllers\CategoriesAdmin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ImageCategory;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Helper\HelperController;

class CategoryController extends Controller
{
    private $helper;

    public function __construct() {
        $this->helper = new HelperController();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $categories = Category::latest();
        if ($request->get('keyword') != null) {
            $categories = $categories->where('name', 'LIKE', '%' . $request->get('keyword') . '%');
        }
        $categories = $categories->paginate(10);

        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->helper->ruleValidate($request, 'store');

        if ($validate->passes()) {            
            return $this->helper->storeAssistant($request , 'category');
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
    }





    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $categoryId)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            return redirect()->route('admin.category.list')->withErrors('Category not found');
        }
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        /* comparison data */
        if (!$category) {
            return redirect()->route('admin.category.list')->with('error', 'Category not found');
        }

        $noChanges = $request->name === $category->name && $request->slug === $category->slug && $request->status == $category->status && !$request->hasFile('image');
        if ($noChanges) {
            return redirect()->route('admin.category.list')->with('warning', 'No changes detected');
        }
        /* comparison data */

        if ($request->hasFile('image')) {

            $validateImage = $this->validateImage($request);

            if ($validateImage->fails()) {
                return redirect()->route('admin.category.list')->with('error', 'Invalid image');
            }

            /* check old image && delete */
            if ($category->image_id) {
                $this->checkOldImage($category);
            }
            /* check old image && delete */


            /* set new Image id && uploade */
            $imageId = $this->uploadImage($request);
            $category->image_id = $imageId;
            /* set new Image id && uploade */

        }


        return $this->helper->finishUpdate($request, $category , 'update' , 'admin.category.list');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $category = Category::find($id);
        
        if (empty($category)) {
            $request->session()->flash('warning', 'category not found');
            return response()->json([
                'status' => true,
                'message' => 'category not found',
            ]);
        }

        $imageCategory = ImageCategory::find($category->image_id);
        $category->delete();
        return $this->destroyAssistant($request , $imageCategory);
    }


 


    private function uploadImage(Request $request)
    {

        $image = $request->file('image');

        $path = $image->store('category/images', 'public');

        $imageCreate = new ImageCategory();
        $imageCreate->name =  $path;
        $imageCreate->save();
        return $imageCreate->id;
    }

    private function validateImage(Request $request)
    {
        $validateImage = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        return $validateImage;
    }


    private function checkOldImage(object | null  $category)
    {
        $oldImage = ImageCategory::find($category->image_id);
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage->name);
            $oldImage->delete();
        }
    }

   




    private function destroyAssistant(Request $request , object | null  $imageCategory) {
        if (!empty($imageCategory)) {
            Storage::disk('public')->delete($imageCategory->name);
            $imageCategory->delete();
        }

        $request->session()->flash('success', 'delete success');
        return response()->json([
            'status' => true,
            'message' => 'delete success',
        ]);
    }


}
