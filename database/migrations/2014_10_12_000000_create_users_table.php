<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
<<<<<<< HEAD
            $table->string('username',50)->unique();
=======
            $table->string('username',50)->unique;
>>>>>>> ba9e0b12dc57c7601998f595c97f9350bcfc49af
            $table->integer('designation');
            $table->integer('division');
            $table->string('email');
            $table->integer('section');
            $table->string('password');
            $table->boolean('user_priv');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
