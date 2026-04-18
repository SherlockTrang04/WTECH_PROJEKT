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
        Schema::table('users', function (Blueprint $table) {
            $table->string('address_street')->nullable()->after('phone');
            $table->string('address_house_number')->nullable()->after('address_street');
            $table->string('address_zip')->nullable()->after('address_house_number');
            $table->string('address_city')->nullable()->after('address_zip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address_street', 'address_house_number', 'address_zip', 'address_city']);
        });
    }
};
