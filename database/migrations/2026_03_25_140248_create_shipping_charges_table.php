<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            
            $table->id(); // ✅ first

            $table->foreignId('country_id')
                  ->constrained('countries')
                  ->onDelete('cascade'); // ✅ correct relation

            $table->double('amount', 10, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipping_charges');
    }
};