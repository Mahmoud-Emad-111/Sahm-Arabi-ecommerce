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
        Schema::create('allmobiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('random_id');
            $table->string('name');
            $table->string('price');
            $table->text('description');
            $table->string('quantity');
            $table->string('purchaseNumber'); //عدد الشراء
            $table->text('desriptionMobile');
            $table->string('image');
            $table->foreignId('mobile_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allmobiles');
    }
};
