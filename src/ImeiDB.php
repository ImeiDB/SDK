<?php

namespace imeidb\sdk;

use GuzzleHttp\Client;
use imeidb\sdk\exceptions\BaseException;

class ImeiDBClient
{
    /**
     * Destination BaseUrl
     * @var string
     */
    protected $baseUrl = 'https://imeidb.xyz';

    const FORMAT_JSON   = 'json';
    const FORMAT_XML    = 'xml';

    /**
     * Please specify the token
     *
     * @url https://imeidb.xyz/user - The token can be found here
     * @var string
     */
    private $token;

    /**
     * @var Client
     */
    private $client;

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

        if (!in_array($format, $this->getListOfSupportedFormats())) {
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

    protected function getListOfSupportedFormats() {
        return ['xml', 'json'];
    }

    /**
     * Returns the account balance
     */
    public function getBalance () {
        return $this->client->get('https://imeidb.xyz/api/balance');
    }

    /**
     * @param $imei
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDecode($imei) {
        return $this->client->get("https://imeidb.xyz/api/imei/${imei}");
    }
}
