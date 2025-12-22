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
        Schema::create('proffecional', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable(); // Job group
            $table->string('name')->nullable(); // Long text for comandate
            $table->string('law')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proffecional');
    }
};
