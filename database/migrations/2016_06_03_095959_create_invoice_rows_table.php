<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_part_id');
            $table->integer('invoice_id');
            $table->integer('service_action_id');
            $table->string('action_part_description');
            
            $table->integer('price_total');
            $table->integer('unit_price');
            $table->string('unit_type');
            
            $table->integer('amount');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_rows');
    }
}
