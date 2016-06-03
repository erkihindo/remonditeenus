<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_device_id');
            $table->integer('service_order_id');
            $table->string('part_name');
            $table->integer('part_price');
            $table->integer('part_count');
            $table->integer('created_by');
            $table->timestamps();
            $table->string('serial_no');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('service_parts');
    }
}
