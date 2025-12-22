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
        Schema::create('profecionalbodies', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('upn_no'); // UPN number
            $table->string('email'); // Email
            $table->string('phone'); // Phone number
            $table->string('name'); // Name
            $table->string('job_group')->nullable(); // Job group (nullable)
            $table->string('is_member'); // Is member (yes/no)
            $table->string('professional_body')->nullable(); // Professional body name (nullable)
            $table->string('law')->nullable(); // Regulating law/statute (nullable)
            $table->string('status')->nullable();
            $table->string('date')->nullable(); // Status (Active/Inactive) (nullable)
            $table->string('document_name')->nullable(); // Document file name (nullable)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profecionalbodies');
    }
};