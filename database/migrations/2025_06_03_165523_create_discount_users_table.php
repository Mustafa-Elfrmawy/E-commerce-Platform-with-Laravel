<?php

use App\Models\User;
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
        Schema::create('discount_users', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->unique()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total_discount', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_users');
    }
};
