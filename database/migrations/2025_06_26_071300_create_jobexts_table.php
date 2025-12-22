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
        Schema::create('jobexts', function (Blueprint $table) {
             $table->id();
            $table->string('area');
           
            $table->string('Specialization');
            $table->string('level');
            $table->string('AE');
            $table->string('IP');
            $table->string('Var');
            $table->string('Ref_NO')->unique();
            $table->date('datefrom');
            $table->date('deadline');
            $table->string('Proposed_No_of_Positions');
            
            $table->string('status')->default('Open');
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobexts');
    }
};
