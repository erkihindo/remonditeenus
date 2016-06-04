<?php

use Illuminate\Database\Seeder;

class ServiceRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_requests')->insert([
            'service_request_status_type_id' => 1,
            'user_id' => 3,
            'created_by' => 1,
            'service_desc_by_customer' => 'help',
            'service_desc_by_employee' => 'what an idiot',
        ]);
    }
}
