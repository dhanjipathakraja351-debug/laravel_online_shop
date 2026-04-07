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
        Schema::create('customers_addresses', function (Blueprint $table) {
            $table->id();

            // ✅ USER RELATION
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // ✅ CUSTOMER DETAILS
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            // ✅ ADDRESS
            $table->string('address');
            $table->string('apartment')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('zip');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers_addresses');
    }
};