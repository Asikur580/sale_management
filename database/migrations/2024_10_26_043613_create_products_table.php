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
            $table->foreignId('cat_id')->constrained('categories');
            $table->foreignId('brand_id')->constrained('brands');
            $table->string('model')->nullable();
            $table->string('serial')->nullable();
            $table->string('warranty')->nullable();
            $table->string('purchese_form')->nullable();
            $table->double('buy_price');
            $table->double('sell_price');
            $table->integer('quantity');
            $table->timestamps();
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
