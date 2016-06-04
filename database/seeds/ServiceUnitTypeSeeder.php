<?php

use Illuminate\Database\Seeder;

class ServiceUnitTypeSeeder extends Seeder
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
            'type_name' => "hr", 
        ],
        [
            'type_name' => "eur", 
        ],
        [
            'type_name' => "op", 
        ]    );
        DB::table('service_unit_types')->insert($types);
    }
}
