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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->index();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('work_type_id')->nullable();
            $table->unsignedBigInteger('salary_type_id')->nullable();
            $table->tinyInteger('typical_hour')->nullable();
            $table->float('annual_salary',8,2)->nullable();
            $table->float('hourly_rate',4,2)->nullable();

            $table->foreign('job_id')->on('jobs')->references('id')->cascadeOnDelete();
            $table->foreign('department_id')->on('jobs')->references('id')->cascadeOnDelete();
            $table->foreign('work_type_id')->on('work_types')->references('id')->cascadeOnDelete();
            $table->foreign('salary_type_id')->on('salary_types')->references('id')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
