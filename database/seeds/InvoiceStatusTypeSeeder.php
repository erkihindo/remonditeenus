<?php

use Illuminate\Database\Seeder;

class InvoiceStatusTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
        [
            'type_name' => "pooleli", 
        ],
        [
            'type_name' => "kinnitatud", 
        ]);
        DB::table('invoice_status_types')->insert($types);
        
    }
}
