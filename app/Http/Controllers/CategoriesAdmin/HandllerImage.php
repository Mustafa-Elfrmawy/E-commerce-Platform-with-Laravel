<?php

namespace App\Http\Controllers\CategoriesAdmin;

use Illuminate\Http\Request;
use App\Models\ImageCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HandllerImage extends Controller
{
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validate->passes()) {
        if ($request->hasFile('image')) {
        return $this->uploadImage($request);
        
        } else {
                return response()->json([
                    'status' => false,
                    'errors' => ['image' => 'Image not found']
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validate->errors()
            ]);
        }
    }





    private function uploadImage(Request $request) {

            $image = $request->file('image');

            $path = $image->store('category/images', 'public');

            $imageCreate = new ImageCategory();
            $imageCreate->name = $path;
            $imageCreate->save();

            return response()->json([
                'status' => true,
                'id' => $imageCreate->id,
                'image' => asset('storage/' . $path),
            ]);
    
    }

}