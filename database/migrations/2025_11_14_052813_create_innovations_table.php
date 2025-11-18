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
        Schema::create('innovations', function (Blueprint $table) {
            $table->id();

            // FK to invent user
            $table->unsignedBigInteger('invent_id')->nullable();
            $table->string('securitykey');

            // Step 1
            $table->string('title');
            $table->longText('content');
             $table->string('industry');

            // Generated number
            $table->string('innovation_number')->unique();

            // Step 2
            $table->string('innovation_type');
            $table->string('attachment')->nullable();
            $table->string('link')->nullable();

            // Step 3
            $table->string('evidence')->nullable();

            // PDF report
            $table->string('report_pdf')->nullable();
             $table->longText('comment')->nullable();
             $table->string('status')->nullable();

            $table->timestamps();

            // Foreign key constraint
            $table->foreign('invent_id')
                ->references('id')
                ->on('invents')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('innovations');
    }
};
