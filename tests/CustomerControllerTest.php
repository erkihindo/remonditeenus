<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use WithoutMiddleware;

    public function testGetAll()
    {        
        $this->json('get', '/getallcustomers', [])
             ->seeJson(["Billy Boy","Bob Bobbington","Steven Seagull"]);
        
    }
}    
    
