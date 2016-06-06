<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('service_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('so_status_type_id');
            $table->integer('service_request_id');
            $table->timestamp('status_changed');
            $table->integer('status_changed_by');
            $table->integer('price_total');
            $table->string('note');
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::drop('service_orders');
    }
}
