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
        Schema::create('salary_generate_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_generate_id');
            $table->foreign('salary_generate_id')->references('id')->on('salary_generates')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('month_year');
            $table->decimal('mobile_allowance', 25, 2);
            $table->decimal('performance_bonus', 25, 2);
            $table->decimal('inc_dec', 25, 2);
            $table->decimal('advance_salary', 25, 2);
            $table->decimal('festival_bonus', 25, 2);
            $table->decimal('employee_basic_salary', 25, 2);
            $table->decimal('employee_grand_total_salary', 25, 2);
            $table->enum('is_paid', ['Not Yet', 'Received'])->default('Not Yet')->nullable();
            $table->enum('payment_method', ['Bank Account', 'Cash in Hand', 'Mobile Banking', 'Office Assets'])->nullable();
            $table->string('attachment')->nullable();
            $table->string('transaction_note', 2000)->nullable();
            $table->string('note', 2000)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_generate_employees');
    }
};
