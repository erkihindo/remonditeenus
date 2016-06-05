<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(CustomerSeeder::class);
         $this->call(InvoiceStatusTypeSeeder::class);
         
         $this->call(ServiceActionStatusTypeSeeder::class);
         $this->call(ServiceDeviceStatusTypeSeeder::class);
         $this->call(ServiceRequestStatusTypeSeeder::class);
         
         $this->call(ServiceRequestSeeder::class);
         $this->call(SoStatusTypeSeeder::class); 
         $this->call(ServiceUnitTypeSeeder::class);
         
         $this->call(ServiceTypeSeeder::class);
         $this->call(DeviceTypeSeeder::class);
         $this->call(DeviceSeeder::class);
    }
}
