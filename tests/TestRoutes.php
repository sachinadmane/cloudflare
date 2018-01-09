<?php
require_once 'PHPUnit/Autoload.php';
use GuzzleHttp\Client;

class TestRoutes extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        $this->http = new Client(['base_uri' => 'http://api.cf.test']);
    }

    public function tearDown()
    {
        $this->http = null;
    }

    /**
     * Test GET
     *
     */

    public function testGet()
    {
        $response = $this->http->request('GET', '/v1/users');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }

    /**
     * Test POST
     *
     */
    public function testPost()
    {

        $data = array();
        $data["firstname"] = uniqid();
        $data["lastname"] = uniqid();
        $data["email"] = uniqid() . "@sharklasers.com";
        $data["password"] = uniqid();


        $response = $this->http->post('/v1/users', [
            GuzzleHttp\RequestOptions::JSON => $data
        ]);
        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }


    /**
     * Test DELETE
     *
     */
    public function testdelete()
    {
        $id=58;

        $response = $this->http->request('DELETE', "/v1/users/$id");

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
}
