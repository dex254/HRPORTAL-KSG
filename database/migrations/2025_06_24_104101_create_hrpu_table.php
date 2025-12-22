<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrpuTable extends Migration
{
    public function up()
    {
        Schema::create('hrpu', function (Blueprint $table) {
            $table->id();
            $table->string('upn_no')->unique();
            $table->string('name')->nullable();
            $table->string('nationality')->nullable();
            $table->date('dob')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('email')->unique();
            $table->string('temp_password')->nullable();
         $table->string('reset_token')->nullable();
          $table->string('temp_password_expiry')->nullable();
            $table->string('acted_by')->nullable();
            $table->string('password_status')->nullable();
            
            $table->string('status')->nullable();
           $table->string('online_status')->nullable();
            $table->timestamp('login_time')->nullable();
            $table->timestamp('logout_time')->nullable();
            $table->string('password');
            $table->string('profile')->nullable(); // Path to profile image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hrpu');
    }
}
