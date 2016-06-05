<?php

use Illuminate\Database\Seeder;

class DeviceTypeSeeder extends Seeder
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
            'super_type_id' => "0", 
            'type_name' => "Arvuti", 
            'level' => 0
        ],
        [
            'super_type_id' => "0", 
            'type_name' => "Kodutehnika", 
            'level' => 0
        ],
        [
            'super_type_id' => "1", 
            'type_name' => "Desktopid", 
            'level' => 1
        ],
        [
            'super_type_id' => "1", 
            'type_name' => "Laptopid", 
            'level' => 1
        ],
        [
            'super_type_id' => "2", 
            'type_name' => "Elektripliidid", 
            'level' => 1
        ],
        [
            'super_type_id' => "2", 
            'type_name' => "Kylmkapid", 
            'level' => 1
        ],
        [
            'super_type_id' => "2", 
            'type_name' => "Pesumasinad", 
            'level' => 1
        ]);
        DB::table('device_types')->insert($types);
    }
}
