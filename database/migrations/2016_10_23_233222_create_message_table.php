<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('body');
            $table->text('title');
            $table->integer('location_id')->unsigned();
            $table->integer('parent_message_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });

        Schema::table('message', function (Blueprint $table) {
            $table->foreign('location_id')->references('id')->on('location')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('parent_message_id')->references('id')->on('message')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::table('message', function (Blueprint $table) {
            $table->dropForeign('message_location_id_foreign');
        });
        Schema::table('message', function (Blueprint $table) {
            $table->dropForeign('message_user_id_foreign');
        });
        Schema::table('message', function (Blueprint $table) {
            $table->dropForeign('message_parent_message_id_foreign');
        });

        Schema::drop('message');
    }
}
