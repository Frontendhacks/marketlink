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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name' , 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10,2);
            $table->integer('stock_quantity')->default(0);
            $table->string('available_day',20);
            $table->enum('status',['active','inactive'])->default('active');
            $table->foreignid('farmer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('market_id');
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
