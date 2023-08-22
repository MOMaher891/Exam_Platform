<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColObserveActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observe_activities', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('exam_time_id');
            $table->foreign('exam_time_id')
                ->references('id')
                ->on('exam_times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observe_activities', function (Blueprint $table) {
            //
        });
    }
}
