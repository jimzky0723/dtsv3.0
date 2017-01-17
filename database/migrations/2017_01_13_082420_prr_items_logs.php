<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PrrItemsLogs extends Migration
{
    public function up()
    {
        if(Schema::hasTable('prr_item_logs')){
            return true;
        }
        Schema::create('prr_item_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('route_no');
            $table->text('prr_logs_key');
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
        Schema::drop('prr_item_logs');
    }
}
