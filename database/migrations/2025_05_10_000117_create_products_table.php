<?php

use App\Models\User;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug', 2000);
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable();
            
            $table->foreignIdFor(Admin::class, 'created_by')->nullable();
            $table->foreignIdFor(Admin::class, 'updated_by')->nullable();
            $table->foreignIdFor(Admin::class, 'deleted_by')->nullable();
            
            $table->string('image_id'  , 255)->nullable();
            $table->foreignIdFor(Category::class, 'category_id')->nullable();
            $table->foreignIdFor(SubCategory::class, 'sub_category_id')->nullable();
            $table->foreignIdFor(Brand::class, 'brand_id')->nullable();
            
            $table->enum('is_featured', ['yes' , 'no'])->default('no');
            $table->enum('track_qty', ['yes' , 'no'])->default('yes');

            $table->string('barcode', 50)->nullable();
            $table->string('sku', 50);
            $table->integer('qty')->default(1);
            $table->tinyInteger( 'status')->defualt(0);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
