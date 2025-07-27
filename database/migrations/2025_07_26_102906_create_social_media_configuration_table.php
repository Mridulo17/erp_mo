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
        Schema::create('social_media_configuration', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('page_name');
            $table->string('page_id', 191)->unique();
            $table->string('app_id');
            $table->string('app_secret');
            $table->string('access_token');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_configuration');
    }
};
