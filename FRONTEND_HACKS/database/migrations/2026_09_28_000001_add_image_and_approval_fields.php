<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
         * USERS
         */
        if (!Schema::hasColumn('users', 'approval_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('approval_status', 20)
                    ->default('approved')
                    ->after('status');
            });
        }

        /*
         * PRODUCTS
         */
        if (!Schema::hasColumn('products', 'image')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('image')
                    ->nullable()
                    ->after('description');
            });
        }

        /*
         * FARMER PROFILES
         */
        if (!Schema::hasColumn('farmer_profiles', 'farm_type')) {
            Schema::table('farmer_profiles', function (Blueprint $table) {
                $table->string('farm_type', 50)
                    ->nullable()
                    ->after('stall_name');
            });
        }

        if (!Schema::hasColumn('farmer_profiles', 'farm_size')) {
            Schema::table('farmer_profiles', function (Blueprint $table) {
                $table->string('farm_size', 100)
                    ->nullable()
                    ->after('farm_type');
            });
        }

        if (!Schema::hasColumn('farmer_profiles', 'city')) {
            Schema::table('farmer_profiles', function (Blueprint $table) {
                $table->string('city', 100)
                    ->nullable()
                    ->after('farm_size');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('farmer_profiles', 'city')) {
            Schema::table('farmer_profiles', function (Blueprint $table) {
                $table->dropColumn('city');
            });
        }

        if (Schema::hasColumn('farmer_profiles', 'farm_size')) {
            Schema::table('farmer_profiles', function (Blueprint $table) {
                $table->dropColumn('farm_size');
            });
        }

        if (Schema::hasColumn('farmer_profiles', 'farm_type')) {
            Schema::table('farmer_profiles', function (Blueprint $table) {
                $table->dropColumn('farm_type');
            });
        }

        if (Schema::hasColumn('products', 'image')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }

        if (Schema::hasColumn('users', 'approval_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('approval_status');
            });
        }
    }
};