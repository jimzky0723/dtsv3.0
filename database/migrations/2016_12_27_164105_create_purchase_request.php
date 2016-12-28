<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseRequest extends Migration
{

    public function up()
    {
        Schema::create('purchase_request', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_no');
            $table->integer('qty');
            $table->string('issue');
            $table->text('description');
            $table->integer('unit_cost');
            $table->integer('cost');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('purchase_request');
    }
}
