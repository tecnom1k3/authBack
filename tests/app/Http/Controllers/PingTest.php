<?php
use App\Http\Controllers\Ping;
use Illuminate\Http\JsonResponse;

class PingTest extends TestCase
{
    /**
     * @var Ping
     */
    protected $controller;

    public function setUp()
    {
        $this->controller = new Ping();
    }

    public function testGetAll()
    {
        $rs = $this->controller->getAll();

        $this->assertTrue($rs instanceof JsonResponse);
        $this->assertSame(200, $rs->getStatusCode());
        $this->assertJson($rs->getContent());
        $data = $rs->getData();

        $this->assertObjectHasAttribute('status', $data);
        $this->assertAttributeEquals('ok', 'status', $data);
    }
}
