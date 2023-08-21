<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableObserves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('observes', function (Blueprint $table) {
            $table->bigInteger('center_id')->after('password')->nullable()->default(null);
            $table->foreign('center_id')
                ->references('id')
                ->on('centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('observes', function (Blueprint $table) {
            //
        });
    }
}
