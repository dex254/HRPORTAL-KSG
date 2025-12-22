<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referees', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no');
            $table->string('email');
            $table->string('phone');
            $table->string('name'); // Your full name
            $table->string('employer');
            $table->string('job_title');
            $table->string('refname'); // Referee name
            $table->string('refphone');
            $table->string('refemail');
            $table->string('Position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referees');
    }
}
