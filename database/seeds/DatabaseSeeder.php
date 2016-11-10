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
            'name' => 'Jimmy Lomocso',
            'username' => 'jimzky',
            'email' => 'jimzky@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }
}
