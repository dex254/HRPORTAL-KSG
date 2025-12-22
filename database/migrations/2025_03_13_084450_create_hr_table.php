<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hr', function (Blueprint $table) {
            $table->id();
            $table->string('s_no')->nullable();
            $table->string('payroll_num')->nullable();
            $table->string('upn_no')->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->string('job_group')->nullable();
            $table->string('campus')->nullable();
            $table->string('job_designation')->nullable();
            $table->string('job_code')->nullable();
            $table->string('idnumber')->nullable();
            $table->string('ethnicity')->nullable();
            $table->string('dob')->nullable();
            $table->string('disability')->nullable();
            $table->string('gender')->nullable();
            $table->string('first_date_of_appointment')->nullable();
            $table->string('current_date_of_appointment')->nullable();
            $table->string('home_county')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->longText('academic_qualifications')->nullable();
            $table->longText('ongoing_long_courses')->nullable();
            $table->longText('career_guideline_requirements')->nullable();
            $table->string('status')->nullable();
            $table->longText('identified_gaps')->nullable();
            $table->string('disability_description')->nullable();
            $table->string('application_status')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hr');
    }
};
