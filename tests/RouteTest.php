<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RouteTest extends TestCase
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