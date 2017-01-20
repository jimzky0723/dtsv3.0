<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrrSupplyLogs extends Migration
{

    public function up()
    {
        Schema::create('prr_supply_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('route_no');
            $table->text('prr_logs_key');
            $table->dateTime('updated_date');
            $table->text('updated_by');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('prr_supply_logs');
    }
}
