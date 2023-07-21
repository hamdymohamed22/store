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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders','id')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->nullable()->constrained('products','id')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name');
            $table->float('price');
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->json('options');

            $table->unique(['order_id','product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
