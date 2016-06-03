<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('service_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_action_status_type_id');
            $table->integer('service_type_id');
            $table->integer('service_device_id');
            $table->integer('service_order_id');
            
            $table->integer('service_amount');
            $table->integer('price');
            $table->integer('created_by');
            $table->timestamps();
            $table->string('action_description');
           
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_actions');
    }
}
