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
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();               
            $table->enum('type', ['percentage', 'fixed']);      
            $table->decimal('value', 3, 1);                     
            // $table->decimal('min_order_amount', 10, 2)->default(0);  
            $table->unsignedInteger('max_uses')->nullable();    
            $table->unsignedInteger('used_count')->default(0);  
            $table->dateTime('start_date')->nullable();         
            $table->dateTime('expiry_date')->nullable();        
            $table->boolean('active')->default(true);           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_codes');
    }
};
