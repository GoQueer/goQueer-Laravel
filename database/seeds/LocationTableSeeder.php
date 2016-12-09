<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert([
            'id'=> '1',
            'coordinate' => '1,2',
            'name' => 'Restaurant',
            'description' => 'Restaurant',
            'address' => 'White Ave, 99 st',
            'user_id' => 1,

        ]);


    }
}
