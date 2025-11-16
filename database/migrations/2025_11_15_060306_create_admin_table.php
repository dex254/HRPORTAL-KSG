<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();

            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            $table->string('password')->nullable();
            $table->boolean('status')->default(1);

            $table->timestamp('login_time')->nullable();
            $table->timestamp('logout_time')->nullable();
            $table->string('last_login_ip')->nullable();

            $table->integer('failed_attempts')->default(0);
            $table->boolean('is_online')->default(false);

            $table->string('profile')->nullable(); // profile image path
            $table->text('activity')->nullable();

            $table->string('digitalsignature')->nullable();

            // OTP + temp password system
            $table->string('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();

            $table->string('temp_password')->nullable();
            $table->timestamp('temp_password_expiry')->nullable();

            // Password reset token
            $table->string('reset_token')->nullable();

            // Access control
            $table->string('role')->default('admin');
            $table->string('dash')->nullable();
            $table->string('approvals')->nullable();
             $table->string('created_by')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
