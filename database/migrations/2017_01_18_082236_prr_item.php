<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrrItem extends Migration
{

    public function up()
    {
        Schema::create('prr_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_no');
            $table->text('prr_logs_key');
            $table->integer('qty');
            $table->text('issue');
            $table->text('description');
            $table->text('specification');
            $table->text('unit_cost');
            $table->text('estimated_cost');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::drop('prr_item');
    }
}
