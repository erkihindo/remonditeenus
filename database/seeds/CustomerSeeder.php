<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Bob Bobbington',
            'email' => 'bob@bob.com',
            'password' => bcrypt('bob'),
        ]);
        
        DB::table('customers')->insert([
            'user_id' => 2,
            
        ]);
        
        
        DB::table('users')->insert([
            'name' => 'Billy Boy',
            'email' => 'billy@billy.com',
            'password' => bcrypt('billy'),
        ]);
        
        DB::table('customers')->insert([
            'user_id' => 3,
            
        ]);
        
        DB::table('users')->insert([
            'name' => 'Steven Seagull',
            'email' => 'steven@steven.com',
            'password' => bcrypt('steven'),
        ]);
        
        DB::table('customers')->insert([
            'user_id' => 4,
            
        ]);
    }
}
