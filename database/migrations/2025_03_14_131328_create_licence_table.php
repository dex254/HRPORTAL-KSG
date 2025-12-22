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
        Schema::create('licence', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('upn_no'); // UPN number
            $table->string('email'); // Email address
            $table->string('phone'); // Phone number
            $table->string('name'); // Name
            $table->string('job_group')->nullable(); // Job group
            $table->string('has_license'); // Whether the user has a license (yes/no)
            $table->string('license_name')->nullable(); // License name
            $table->date('license_date')->nullable(); // License date
            $table->string('document_name')->nullable(); // Name of the uploaded document
            $table->timestamps(); // created_at and updated_at timestamps
        });
            
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licence');
    }
};
