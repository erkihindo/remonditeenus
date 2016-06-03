<?php

use Illuminate\Database\Seeder;

class ServiceDeviceStatusTypeSeeder extends Seeder
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
            'type_name' => "vastu võetud", 
        ],
        [
            'type_name' => "töö seadmega lõpetatud", 
        ],
        [
            'type_name' => "seade kliendile tagastatud", 
        ]    );
        DB::table('service_device_status_types')->insert($types);
    }
}
