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
        Schema::create('markets', function (Blueprint $table) {
            $table->id('market_id');
            $table->string('market_name',100);
            $table->text('address');
            $table->string('day', 20);
            $table->string('timing', 100);
            $table->decimal('latitude', 10,8);
            $table->decimal('longitude', 11,8);
            $table->string('map_provider', 30)->default('OpenStreetMap');
            $table->enum('status',['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
