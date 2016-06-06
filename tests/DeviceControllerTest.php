<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeviceControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use WithoutMiddleware;
    
    public function testAllDevices()
    {
        $this->get('/devices')->seePageIs('/devices');
    }
    
    public function testCreateDevice() {
        $response = $this->call('POST', '/createdevice', [
            'name' => 'NewDevice',
            'model' => 'model',
            'reg_no' => 'ASD555',
            'description' => 'New',
            'manufacturer' => 'Me',
            'device_type_id' => 1,
            
            ]);
        $this->assertNotEmpty($response);
        
    }
    
    public function testGetTypes()
    {        
        $this->json('get', '/getdevicetypes', [])
             ->seeJson([["...Desktopid", 3], ["...Elektripliidid", 5], ["...Kylmkapid", 6], ["...Laptopid", 4], ["...Pesumasinad", 7], ["Arvuti", 1], ["Kodutehnika", 2]]);
        
    }
    
    public function testSearchForDevices() {
        $response = $this->call('GET', '/finddevices', [
            
            'device_type' => 1,
            
            ]);
        echo $response;
       $this->assertNotEmpty($response);
       
    }
    
    
    public function testFindByID() {
        $response = $this->call('GET', '/getdevicename', [
            
            'id' => 1,
            
            ]);
        echo "\n------------------";
        echo $response;
       $this->assertNotEmpty($response);
    }
    
    
    
}
