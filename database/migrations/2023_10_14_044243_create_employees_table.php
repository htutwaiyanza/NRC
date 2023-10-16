<?php

use App\Models\BloodType;
use App\Models\Gender;
use App\Models\MartialStatus;
use App\Models\Nationality;
use App\Models\Nrc2;
use App\Models\Religion;
use App\Models\Vacancy;
use App\Models\Employee;
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
            $table->string('employee_en');
            $table->string('employee_mm');
            $table->string('father_name');
            $table->string('date_of_birth');
            // $table->string('nrc');
            $table->string('race');


            $table->foreignId('religion_id')->constrained();
            $table->foreignId('nationality_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vacancy_id')->constrained()->cascadeOnDelete();
            // $table->foreignId('nrc_posts_id')->constrained()->cascadeOnDelete();

            $table->string('passport');
            $table->string('name');
            $table->string('driver_licene');
            // $table->string('nrc');
            $table->foreignId('nrc1_id')->constrained()->cascadeOnDelete();
            $table->foreignId('nrc2_id')->constrained('nrc2s')->cascadeOnDelete();
            $table->foreignId('nrc2_n')->constrained('nrc2s')->cascadeOnDelete();
            $table->foreignId('gender_id')->constrained()->cascadeOnDelete();
            $table->foreignId('blood_types_id')->constrained()->cascadeOnDelete();
            $table->foreignId('martial_status_id')->constrained()->cascadeOnDelete();

            $table->boolean('education_info')->default(true);
            $table->boolean('working_info')->default(true);
            $table->boolean('family_member_info')->default(true);
            $table->boolean('addresses')->default(true);

            $table->integer('home_phone');
            $table->integer('mobile_phone');
            $table->string('url');
            // $table->string('education');
            // $table->string('education_degree');
            // $table->string('education_from');
            // $table->string('education_to');
            // $table->string('school');
            // $table->string('working');
            // $table->string('job');
            // $table->string('company_name');
            // $table->string('job_from');
            // $table->string('job_to');
            // $table->string('employer_contact');
            // $table->string('employer_address');
            $table->string('family_member_name');
            $table->string('relationship');
            $table->string('family_date_of_birth');
            $table->string('occupation');
            $table->string('contact_phone_number');
            $table->string('family_address');
            // $table->string('contact_address');
            $table->string('country');
            $table->string('state');
            $table->string('township');
            $table->string('street');
            $table->timestamps();
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
