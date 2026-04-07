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
    Schema::table('reviews', function (Blueprint $table) {
        $table->boolean('status')->default(0); // 0 = pending, 1 = approved
    });
}

public function down(): void
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->dropColumn('status');
    });
  }
};
