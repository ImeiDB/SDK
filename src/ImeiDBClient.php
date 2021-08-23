<?php

namespace imeidb\sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use imeidb\sdk\exceptions\BaseException;
use Psr\Http\Message\ResponseInterface;

require __DIR__ . '/vendor/autoload.php';

class ImeiDBClient
{
    /**
     * Destination BaseUrl
     * @var string
     */
    protected string $baseUrl = 'https://imeidb.xyz';

    /**
     * Supported formats
     */
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';

    /**
     * Please specify the token
     *
     * @url https://imeidb.xyz/user - The token can be found here
     * @var string
     */
    private string $token;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * ImeiDBClient constructor.
     */
    public function __construct($token = '', $format = self::FORMAT_JSON)
    {
        if (empty($token)) {
            return new BaseException('Token does not specified');
        } else {
            $this->token = $token;
        }

        if (!in_array($format, $this->getFormats())) {
            return new BaseException('Format not supported');
        } else {
            $this->format = $format;
        }

        $this->client = new Client([
            'baseUrl' => $this->baseUrl,
            'headers' => [
                'X-Api-Key' => $this->token
            ],
            'query' => [
                'format' => $this->format
            ]
        ]);
    }

    /**
     * Return list of available formats
     *
     * @return string[]
     */
    protected function getFormats(): array
    {
        return [self::FORMAT_JSON, self::FORMAT_XML];
    }

    /**
     * Returns the account balance
     */
    public function getBalance(): ResponseInterface
    {
        return $this->client->get('https://imeidb.xyz/api/balance');
    }

    /**
     * @param $imei
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getDecode($imei): ResponseInterface
    {
        return $this->client->get("https://imeidb.xyz/api/imei/", [
            'query' => [
                'token' => $imei
            ]
        ]);
    }
}
