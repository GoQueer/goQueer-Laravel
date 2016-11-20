<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id')->unsigned();
            $table->integer('media_id')->unsigned();
        });

        Schema::table('location_media', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('location')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('media_id')->references('id')->on('media')
                ->onDelete('restrict')
                ->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_media', function (Blueprint $table) {
            $table->dropForeign('location_media_location_id_foreign');
        });
        Schema::table('location_media', function (Blueprint $table) {
            $table->dropForeign('location_media_media_id_foreign');
        });

        Schema::drop('location_media');
    }
}
