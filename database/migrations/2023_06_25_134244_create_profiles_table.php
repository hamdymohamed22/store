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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users','id')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name',255);
            $table->string('last_name',255);
            $table->date('birhdate')->nullable();
            $table->string('image',255)->nullable();
            $table->enum('gender',['male','female'])->default('male');
            $table->string('country',100);
            $table->string('state',255); 
            $table->string('city',255); 
            $table->text('str_address')->nullable();
            $table->string('postal_code')->nullable();
            $table->char('locale',2)->default('en');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
