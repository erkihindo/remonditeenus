<?php

use Illuminate\Database\Seeder;

class ServiceRequestStatusTypeSeeder extends Seeder
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
            'type_name' => "registreeritud", 
        ],
        [
            'type_name' => "tagasi lükatud", 
        ],
        [
            'type_name' => "tellimus tehtud", 
        ]);
        DB::table('service_request_status_types')->insert($types);
    }
}
