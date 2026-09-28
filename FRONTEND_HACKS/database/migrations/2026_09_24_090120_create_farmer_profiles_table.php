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
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id('farmer_profile_id');
            $table->string('stall_name', 100);
            $table->text('stall_description')->nullable();
            $table->decimal('latitude', 10,8)->nullable();
            $table->decimal('longitude', 11,8)->nullable();
            $table->string('map_provider', 30)->default('OpenStreetMap');
            $table->enum('status',['pending','approved','suspended'])->default('pending');
            $table->foreignId('farmer_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('market_id')->constrained('markets', 'market_id')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['farmer_id','market_id']);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_profiles');
    }
};
