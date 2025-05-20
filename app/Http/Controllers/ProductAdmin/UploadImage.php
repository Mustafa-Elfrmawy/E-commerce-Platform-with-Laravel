<?php

namespace App\Http\Controllers\ProductAdmin;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UploadImage extends Controller
{
    //
    public function store(Request $request , string $status)
    {
        if( $status  === 'storeProduct'):
            $validate = Validator::make($request->all(), [
                'image' => 'nullable|array|max:10',
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        elseif($status  === 'updateProduct'):
        $validate = Validator::make($request->all(), [
                'image' => 'nullable|array|max:' . $request->maxImage,
                'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        endif;
        if ($validate->fails()) {
            return (object) $validate->errors();
        } 
            $uploadedImages = [];

            foreach ($request->file('image') as $image) {

                $uploadedImages[] = $this->uploadImage($image);
            }

            return $uploadedImages; 
    }

    private function uploadImage($image)
    {

        $path = $image->store('product/images', 'public');
        $imageCreate = new ProductImage();
        $imageCreate->image_product = $path;
        $imageCreate->save();

        return   $imageCreate->id;
    }


    public function deleteImage(string $id, string $idProduct)
    {
        $image = ProductImage::find($id);
        if (!$image) {
            return response()->json(['status' => false, 'message' => 'Image not found']);
        }

        $imageProduct = Product::find($idProduct);

        if (!$imageProduct || empty($imageProduct->image_id) ) {
            return response()->json(['status' => false, 'message' => 'Product not found']);
        }

        $image_id = explode(',', $imageProduct->image_id);

        if (in_array($image->id, $image_id)) {
            
            $image_id = array_diff($image_id, [$image->id]);
            $imageProduct->image_id = implode(',', $image_id);
            $imageProduct->save();

            if (Storage::disk('public')->exists($image->image_product)) {
                Storage::disk('public')->delete($image->image_product);
            }

            $image->delete();

            return response()->json([
                'status' => true,
                'message' => 'Image deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'You do not have this image in the product',
            ]);
        }
    }
}
