<?php

use Illuminate\Database\Seeder;

class SoStatusTypeSeeder extends Seeder
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
            'type_name' => "Töö vastu võetud", 
        ],
        [
            'type_name' => "Valmis", 
        ],
        [
            'type_name' => "Hinnastatud", 
        ],
        [
            'type_name' => "Arve tehtud", 
        ],
        [
            'type_name' => "Seade tagastatud", 
        ]    );
        DB::table('so_status_types')->insert($types);
    }
}
