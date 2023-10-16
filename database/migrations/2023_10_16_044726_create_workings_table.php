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
        Schema::create('workings', function (Blueprint $table) {
            $table->id();
            // $table->string('working_name');
            $table->string('job');
            $table->string('company_name');
            $table->string('job_from');
            $table->string('job_to');
            $table->string('employer_contact');
            $table->string('employer_address');
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workings');
    }
};
