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
            $table->string('name', 255)->unique();
            $table->string('slug', 255)->unique();

            $table->tinyInteger('status')->default(1);
            $table->enum('showhome', ['yes', 'no'])->default('yes');
            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained('sub_categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreignIdFor(ImageCategory::class)->nullable()->constrained()->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }
// 2025_04_30_230607


// 2025_05_05_210604
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
