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
            $table->integer('service_device_status_type_id');
            $table->integer('service_order_id');
            $table->timestamp('to_store');
            $table->timestamp('from_store');
            $table->string('service_description');
            $table->integer('store_status');
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
         Schema::drop('service_devices');
    }
}
