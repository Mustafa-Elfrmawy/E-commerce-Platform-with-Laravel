<?php

use App\Models\ImageCategory;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string( 'name' , 255)->unique();
            $table->string( 'slug' , 255)->unique();
            $table->tinyInteger( 'status')->defualt(1);
            $table->foreignIdFor(ImageCategory::class, 'image_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
