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
        Schema::create('shopproduct', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('random_id');
            $table->string('name');
            $table->string('price');
            $table->text('sub_description');
            $table->text('description');
            $table->json('image_array')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopproduct');
    }
};
