<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentNameToOthersTable extends Migration
{
    public function up()
    {
        Schema::table('others', function (Blueprint $table) {
            $table->string('document_name')->nullable()->after('type');
        });
    }

    public function down()
    {
        Schema::table('others', function (Blueprint $table) {
            $table->dropColumn('document_name');
        });
    }
}
