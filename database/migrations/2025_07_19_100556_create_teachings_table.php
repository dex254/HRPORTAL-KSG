<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingsTable extends Migration
{
    public function up()
    {
        Schema::create('teachings', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no');
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->longText('teaching_areas'); // Long text for Teachingareas
            $table->string('employer');
            $table->string('job_title');
            $table->string('country');
            $table->date('stdate');
            $table->date('enddate');
            $table->string('location');
            $table->text('duties')->nullable();
            $table->text('achievements')->nullable();
            $table->string('teaching_path')->nullable(); // File path
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachings');
    }
}
