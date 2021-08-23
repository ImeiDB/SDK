<?php

use PHPUnit\Framework\TestCase;
use imeidb\sdk\ImeiDBClient;

final class ImeiDbClientTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $client = new ImeiDBClient('');
        $response = $client->getBalance();

        var_dump($response);

        assert($response->getStatusCode(), 200);
    }
}
