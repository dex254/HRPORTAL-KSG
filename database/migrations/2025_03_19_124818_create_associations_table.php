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
        Schema::create('associations', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no');
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->string('job_group')->nullable();
            $table->string('condition'); // 'yes' or 'no'
            $table->string('association_name')->nullable();
            $table->string('status')->nullable();
            $table->string('date')->nullable(); // 'Active' or 'Inactive'
            $table->string('document_name')->nullable(); // File path for the uploaded document
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associations');
    }
};