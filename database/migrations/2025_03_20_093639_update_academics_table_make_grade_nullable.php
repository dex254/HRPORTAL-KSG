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
        
            //
            Schema::table('academics', function (Blueprint $table) {
                // Make the 'grade' column nullable
                $table->string('grade')->nullable()->change();
            });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('academics', function (Blueprint $table) {
            // Revert the 'grade' column to not nullable
            $table->string('grade')->nullable(false)->change();
        });
    }
};
