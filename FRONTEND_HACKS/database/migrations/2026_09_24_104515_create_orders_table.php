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
            $table->id('order_id');
            $table->decimal('total_amount', 10,2);
            $table->integer('quantity');
            $table->enum('order_status',['pending','confirmed','cancelled','completed'])->default('pending');
            $table->dateTime('order_date');
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
        Schema::dropIfExists('orders');
    }
};
