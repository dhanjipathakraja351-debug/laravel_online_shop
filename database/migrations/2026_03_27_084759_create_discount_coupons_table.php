<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();

            // discount coupon code
            $table->string('code');

            // human readable description
            $table->text('description')->nullable();

            // max uses this coupon has
            $table->integer('max_uses')->nullable();

            // whether coupon is percent or fixed
            $table->enum('type', ['percent', 'fixed'])->default('fixed');

            // discount amount
            $table->double('discount_amount', 10, 2);

            // status
            $table->integer('status')->default(1);

            // start date
            $table->timestamp('starts_at')->nullable();

            // expiry date
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_coupons');
    }
};