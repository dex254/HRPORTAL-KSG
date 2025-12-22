<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoremandateTable extends Migration
{
    public function up()
    {
        Schema::create('coremandate', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('upn_no'); // UPN number
            $table->string('email'); // Email address
            $table->string('phone'); // Phone number
            $table->string('name'); // Name
            $table->string('job_group')->nullable(); // Job group
            $table->longText('comandate')->nullable(); // Long text for comandate
            $table->string('selected_count')->nullable();// Number of selected items
            $table->dateTime('date'); // Date and time
            $table->string('status'); // Status with default value 'Active'
            $table->timestamps(); // Optional: created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('coremandate');
    }
}