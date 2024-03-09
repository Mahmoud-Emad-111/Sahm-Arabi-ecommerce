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
        Schema::create('wallet_shops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('random_id')->default(0);;
            $table->enum('company', ['Etislat', 'vodafone', 'orange','We']);
            $table->string('phone_number')->unique();
            $table->foreignId('shop_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_shops');
    }
};
