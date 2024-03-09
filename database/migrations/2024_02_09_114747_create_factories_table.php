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
        Schema::create('factories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('random_id');
            $table->string('name');
            $table->string("logo");
            $table->string('country');
            $table->string('governorate');
            $table->string('region');
            $table->string('address');
            $table->string('phone_number',12)->unique()->nullable();
            $table->string('whatsapp_number',12)->unique()->nullable();
            $table->string('urlStore');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('workingScops');
            $table->text('description');
            $table->text('sub_description');
            $table->string('imageCard_one');
            $table->string('imageCard_two');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factories');
    }
};
