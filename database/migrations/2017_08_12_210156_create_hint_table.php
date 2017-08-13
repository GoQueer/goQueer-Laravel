<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hint', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('content');
            $table->integer('set_id')->unsigned();

        });

        Schema::table('hint', function (Blueprint $table) {
            $table->foreign('set_id')->references('id')->on('sets');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hint', function (Blueprint $table) {
            $table->dropForeign('hint_set_id_foreign');
        });
        Schema::drop('hint');
    }
}
