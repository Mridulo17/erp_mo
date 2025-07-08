<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviewed_candidates', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('full_name')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviewed_candidates');
    }
}; 