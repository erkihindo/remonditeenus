<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_devices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id');
            $table->integer('service_order_id');
            $table->timestamp('to_store');
            $table->timestamp('from_store');
            $table->string('service_description');
            $table->timestamp('status_changed');
            $table->integer('store_status');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('service_devices');
    }
}
