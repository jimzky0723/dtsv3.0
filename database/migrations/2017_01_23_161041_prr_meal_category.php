<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrrMealCategory extends Migration
{

    public function up()
    {
        if(Schema::hasTable('prr_meal_category')){
            return true;
        }
        Schema::create('prr_meal_category', function (Blueprint $table) {
            $table->increments('id');
            $table->text('route_no');
            $table->text('category_desc');
            $table->text('unit_cost');
            $table->text('estimated_cost');
            $table->text('category_row');
            $table->text('prr_logs_key');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('prr_meal_category');
    }
}
