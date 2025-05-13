<?php

namespace App\Http\Controllers\ProductAdmin;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadImage extends Controller
{
    //
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'image' => 'nullable|array|max:10',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validate->fails()) {
            return ['Image_errors' => $validate->errors()];
        }

        if ($request->hasFile('image')) {
            $uploadedImages = [];

            foreach ($request->file('image') as $image) {

                $uploadedImages[] = $this->uploadImage($image);
            }

            return $uploadedImages;
        } else {
            return ['Image_errors' => 'while upload image'];
        }
    }

    private function uploadImage($image)
    {

        $path = $image->store('product/images', 'public');
        $imageCreate = new ProductImage();
        $imageCreate->image_product = $path;
        $imageCreate->save();

        return [
            'id' => $imageCreate->id,
            'image_name' => asset('storage/' . $path),
        ];
    }


    public function deleteImage($id)
    {
        $image = ProductImage::find($id);
        if ($image) {

            if (Storage::disk('public')->exists($image->image_product)) {
                Storage::disk('public')->delete($image->image_product);
            }



            $image->delete();

            return response()->json(['status' => true, 'message' => 'Image deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'Image not found']);
        }
    }
}
