<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 255);
            $table->string('slug' , 255);
            $table->tinyInteger( 'status')->defualt(0);
            $table->enum( 'showhome', ['yes' , 'no'])->default('yes');
            $table->foreignId('sub_category_id')
            ->nullable() 
            ->constrained('sub_categories')  
            ->onDelete('set null')  
            ->onUpdate('cascade');
      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
