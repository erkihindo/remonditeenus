<?php

use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $devices = array(
        [
            'device_type_id' => "4", 
            'name' => "Dell black slim", 
            'reg_no' => 'wp627775848',
            'model' => 'slim',
            'manufacturer' => 'DELL'
        ],
        [
            'device_type_id' => "3", 
            'name' => "Apple box", 
            'reg_no' => 'asdf5221488',
            'model' => 'gaming',
            'manufacturer' => 'Apple'
        ]);
        DB::table('devices')->insert($devices);
    }
}
