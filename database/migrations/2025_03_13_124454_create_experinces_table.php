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
        Schema::create('experinces', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no');
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->string('employer');
            $table->string('job_title');
            $table->string('country');
            $table->date('stdate');
            $table->date('enddate');
            $table->string('location');
           
            $table->text('expartise')->nullable();
            $table->longText('duties')->nullable();
            $table->longText('special')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experinces');
    }
};
