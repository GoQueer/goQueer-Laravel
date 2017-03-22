<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationAddGalleryIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::statement("ALTER TABLE `location` ADD `gallery_id` INT(10)");
        Schema::table('location', function (Blueprint $table) {
            $table->integer('gallery_id')->unsigned();
            $table->foreign('gallery_id')->references('id')->on('gallery');
//            $table->foreign('user_id')->references('id')->on('users');
        });

//        DB::statement("ALTER TABLE `location` ADD CONSTRAINT `location_gallery_id_foreign` FOREIGN KEY (gallery_id) REFERENCES gallery(id);");
        DB::statement("ALTER TABLE `gallery` DROP foreign key `gallery_location_id_foreign`");
        DB::statement("ALTER TABLE `gallery` DROP COLUMN `location_id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
