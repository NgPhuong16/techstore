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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('image');
            $table->float('price');
            $table->float('sale_price')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('detail')->nullable();
            $table->bigInteger('view')->nullable();
            // $table->string('status');
            $table->smallInteger('status')->default(1)->nullable()->comment('0: hide, 1: show');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
            // xóa categories thì xóa luôn những sản phẩm onDelete('cascade')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
