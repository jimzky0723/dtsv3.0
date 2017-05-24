<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrrMealSpecs extends Migration
{
    public function up()
    {
        if(Schema::hasTable('prr_meal_specs')){
            return true;
        }
        Schema::create('prr_meal_specs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_no');
            $table->text('specification');
            $table->integer('expected');
            $table->text('guaranteed');
            $table->text('date_time');
            $table->text('category_row');
            $table->text('prr_logs_key');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('prr_meal_specs');
    }
}
