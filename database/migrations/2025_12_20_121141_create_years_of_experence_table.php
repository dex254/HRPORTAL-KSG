<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('years_of_experence', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no')->index();
            $table->string('email')->index();
            $table->unsignedTinyInteger('years');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('years_of_experence');
    }
};
