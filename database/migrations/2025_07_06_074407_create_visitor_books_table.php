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
        Schema::create('visitor_books', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('full_name')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('candidate_type_id')->nullable();
            $table->string('reference_type')->nullable();
            $table->string('how_find_us')->nullable();
            $table->string('entry_time')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('entry_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_books');
    }
};
