<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'fname' => 'John',
                'lname' => 'X.',
                'mname' => 'Doe',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('user'),
                'user_priv' => 0,
                'user_priv' => 1
            ]);
    }
}
