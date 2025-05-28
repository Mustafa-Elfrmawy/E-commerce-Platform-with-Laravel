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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name' , 255);
            $table->string('last_name' , 255);
            $table->string('email');
            $table->string('phone');
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Country::class)->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('apartment')->nullable();
            $table->string('notes_order')->nullable();
            $table->smallInteger('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
