<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('invoice_status_type_id');
            $table->integer('service_order_id');
            
            $table->timestamp('invoice_date');
            $table->date('due_date');
            $table->integer('price_total');
            
           
            $table->string('receiver_name');
            $table->string('reference_number');
            $table->string('receiver_accounts');
            
            $table->date('payment_date');
           
            $table->date('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoices');
    }
}
