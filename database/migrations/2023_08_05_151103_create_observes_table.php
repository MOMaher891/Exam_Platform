<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('national_id')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('nationality');
            $table->double('price')->default(0);
            $table->boolean('is_active')->default(false);
            $table->string('job_title');
            $table->date('birth_date');
            $table->enum('gender',['male','female'])->nullable()->default("male");
            $table->date('expire_date');

            //files 
            $table->string('img_personal');
            $table->string('img_national');
            $table->string('img_passport');
            $table->string('img_certificate');
            $table->string('img_certificate_good_conduct');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observes');
    }
}
