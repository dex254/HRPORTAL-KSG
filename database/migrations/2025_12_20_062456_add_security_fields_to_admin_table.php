<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->string('otp')->nullable()->after('password');
            $table->string('temp_password')->nullable()->after('otp');
            $table->timestamp('temp_password_expiry')->nullable()->after('temp_password');
            $table->string('reset_token')->nullable()->after('temp_password_expiry');
            $table->timestamp('otp_expires_at')->nullable()->after('reset_token');
        });
    }

    public function down(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            $table->dropColumn([
                'otp',
                'temp_password',
                'temp_password_expiry',
                'reset_token',
                'otp_expires_at',
            ]);
        });
    }
};
