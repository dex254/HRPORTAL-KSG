<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('academics', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no'); // Unique Personal Number
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->string('institution');
            $table->string('course');
            $table->string('level');
            $table->date('stdate'); // Start Date
            $table->date('enddate'); // End Date
            $table->string('grade');
            $table->string('Education_type');
            $table->string('document_name')->nullable();  // Stores the uploaded file path
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academics');
    }
};
