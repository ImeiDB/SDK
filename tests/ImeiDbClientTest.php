<?php

use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use imeidb\sdk\ImeiDBClient;

require_once __DIR__ . "/../src/ImeiDBClient.php";

final class ImeiDbClientTest extends TestCase
{
    protected ImeiDBClient $client;

    public function setUp(): void
    {
        parent::setUp();

        $this->client = new ImeiDBClient(getenv('IMEIDB_TOKEN'));
    }

    /**
     * @throws GuzzleException
     */
    public function testBalance(): void
    {
        $response = $this->client->getBalance();
        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());

        $this->assertEquals(0.15, $data->balance);
        $this->assertEquals('USD', $data->currency);
    }

    /**
     * @throws GuzzleException
     */
    public function testDecode(): void
    {
        $response = $this->client->getDecode(353993102003935);
        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());
        $this->assertEquals(true, $data->success);
        $this->assertEquals('353993102003935', $data->query);
        $this->assertEquals(true, $data->data->valid);
    }

    /**
     * @throws GuzzleException
     */
    public function testNotFoundError(): void
    {
        $response = $this->client->getDecode('000000000000000', ['http_errors' => false]);
        $this->assertEquals(404, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents());
        $this->assertEquals(false, $data->success);
        $this->assertEquals(404, $data->code);
    }
}
