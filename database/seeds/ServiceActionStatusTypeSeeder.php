<?php

use Illuminate\Database\Seeder;

class ServiceActionStatusTypeSeeder extends Seeder
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
            'type_name' => "valmis", 
        ],
          );
        DB::table('service_action_status_types')->insert($types);
    
    }
}
