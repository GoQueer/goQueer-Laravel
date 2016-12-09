<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('content');
			$table->integer('user_id')->unsigned();
			$table->integer('media_id')->unsigned();
		});

		Schema::table('comment', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
			$table->foreign('media_id')->references('id')->on('media')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('comment', function(Blueprint $table) {
			$table->dropForeign('comment_user_id_foreign');
			$table->dropForeign('comment_media_id_foreign');
		});		

		Schema::drop('comment');
	}

}
