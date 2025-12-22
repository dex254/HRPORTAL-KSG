<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAiChartsTable extends Migration
{
    public function up()
    {
        Schema::create('ai_charts', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address'); // identifies user
            $table->text('question');     // user's question or charting request
            $table->text('response')->nullable(); // AI's response (could include chart data)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ai_charts');
    }
}