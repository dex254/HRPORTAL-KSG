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
        Schema::table('extjobs', function (Blueprint $table) {
            //
            $table->text('qualifications')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extjobs', function (Blueprint $table) {
            //
            $table->dropColumn('qualifications');
        });
    }
};
