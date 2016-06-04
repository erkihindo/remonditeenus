<?php

use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
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
            'service_unit_type_id' => "3", 
            'type_name' => "Kerge töö", 
            'service_price' => 10
        ],
        [
            'service_unit_type_id' => "2", 
            'type_name' => "Keskmine töö", 
            'service_price' => 50
        ],
        [
            'service_unit_type_id' => "1", 
            'type_name' => "Raske töö",
            'service_price' => 100
        ]);
        DB::table('service_types')->insert($types);
    }
}
