<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();

            $table->double('price',10,2);
            $table->double('compare_price',10,2)->nullable();

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade');

            $table->boolean('is_featured')->default(0);

            $table->string('sku');
            $table->string('barcode')->nullable();

            $table->boolean('track_qty')->default(1);

            $table->integer('qty')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};