<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('upn_no');
            $table->string('Client');
            $table->string('Sector');
            $table->string('completed');
            $table->date('compedate');
            $table->string('Amount')->nullable();
            $table->string('type'); // Consultancy or Research
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('others');
    }
}
