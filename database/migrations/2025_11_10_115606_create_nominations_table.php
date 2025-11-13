<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('nominations', function (Blueprint $table) {
        $table->id();
        $table->string('country')->default('Kenya');
        $table->string('county');
        $table->string('subcounty');
        $table->string('nominee_name');
        $table->string('work_station');
        $table->string('designation');
        $table->text('duties');
        $table->text('outstanding_behavior');
        $table->text('justification');
        $table->text('lessons');
        $table->string('attachment_path')->nullable();
        $table->string('ip_address')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nominations');
    }
};
