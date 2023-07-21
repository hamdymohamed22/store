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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders','id')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->enum('address_type',['shipping','billing']);
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->string('email',255)->nullable();
            $table->string('phone',255);
            $table->text('str_address');
            $table->string('city',255);
            $table->string('postal_code',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('country',255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
