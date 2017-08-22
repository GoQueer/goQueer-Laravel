<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile')->insert([
            'id'=> '1',
            'description' => 'Edmonton\'s Queer History',
            'name' => 'Edmonton',
        ]);

        DB::table('profile')->insert([
            'id'=> '2',
            'description' => 'Dream City ',
            'name' => 'just dreamy',
        ]);



    }
}
