<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColInExam extends Migration
{
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->enum('type',['private','public']);
            $table->string('centers')->nullable();
        });
    }

    public function down()
    {
        Schema::table('exams', function (Blueprint $table) {
            //
        });
    }
}
