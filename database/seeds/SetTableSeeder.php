<?php

use Illuminate\Database\Seeder;

class SetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sets')->insert([
            'id'=> '1',
            'description' => 'Demo Description',
            'name' => 'Demo',


        ]);



    }
}
