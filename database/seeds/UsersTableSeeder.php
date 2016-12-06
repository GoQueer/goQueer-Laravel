<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=> '1',
            'username' => 'bamdad',
            'email' => 'bamdad.ag@gmail.com',
            'password' => Hash::make('1234'),
            'role_id' => '1',
        ]);
    }
}
