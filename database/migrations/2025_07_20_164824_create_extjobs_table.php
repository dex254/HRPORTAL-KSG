<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtjobsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('extjobs', function (Blueprint $table) {
            $table->id();
            $table->string('Designation');
            $table->string('Job_Group');
            $table->string('level');
            $table->string('Proposed_No_of_Positions');
            $table->string('AE');
            $table->string('IP');
            $table->string('Var');
            $table->string('Ref_NO');
            $table->date('datefrom');
            $table->date('deadline');
            $table->string('status'); // 'Open' or 'Closed'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extjobs');
    }
}
