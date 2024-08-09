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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->string('option');
            $table->bigInteger('quantity')->nullable();
            $table->float('price');
            $table->float('sale_price')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->smallInteger('status')->default(1)->nullable()->comment('0: hide, 1: show');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
