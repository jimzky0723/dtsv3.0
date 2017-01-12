<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrrUpdateHistory extends Migration
{

    public function up()
    {
        Schema::create('prr_update_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_no');
            $table->dateTime('updated_date');
            $table->text('updated_by');
            $table->integer('qty');
            $table->string('issue');
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
        Schema::drop('prr_update_history');
    }
}
