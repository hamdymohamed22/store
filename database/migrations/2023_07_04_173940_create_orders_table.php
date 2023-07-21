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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users','id')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('store_id')->constrained('stores','id')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('number')->unique();
            $table->enum('status',['pending','processing','delivering','completed'
            ,'cancelled','refunded'])
            ->default('pending');
            $table->string('payment_method',255);
            $table->enum('payment_status',['pending','paid','failed'])
            ->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
