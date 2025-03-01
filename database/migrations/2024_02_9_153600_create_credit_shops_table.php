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
        Schema::create('credit_shops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('random_id');
            $table->string("name");
            $table->string("number_card", 16)->unique();
            $table->string("ccv", 3)->unique();
            $table->string('date');
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_shops');
    }
};
