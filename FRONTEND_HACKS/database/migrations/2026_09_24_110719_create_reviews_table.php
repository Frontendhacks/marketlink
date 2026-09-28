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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->text('farmer_reply')->nullable();
            $table->enum('status',['active','removed'])->default('active');
            $table->dateTime('review_date');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->constrained('products','product_id')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
