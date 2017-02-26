<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPingGetAll()
    {
        $this->get('/ping');
        $this->assertResponseOk();
        $this->seeJsonEquals(['status'=>'ok']);
    }
}