<?php

namespace imeidb\sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use imeidb\sdk\exceptions\BaseException;
use Psr\Http\Message\ResponseInterface;

require __DIR__ . '/../vendor/autoload.php';

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
     * Response format
     *
     * @var string
     */
    private string $format;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * ImeiDBClient constructor.
     */
    public function __construct($token = '', $format = self::FORMAT_JSON)
    {
        $this->setToken($token);
        $this->setFormat($format);

        $this->client = new Client([
            'baseUrl' => $this->baseUrl,
            'headers' => [
                'X-Api-Key' => $this->token,
            ],
            'query' => [
                'format' => $this->format
            ]
        ]);
    }

    /**
     * Set request token
     *
     * @param $token
     * @throws BaseException
     * @return ImeiDBClient
     */
    public function setToken($token): ImeiDBClient
    {
        if (empty($token)) {
            throw new BaseException('Token does not specified');
        } else {
            $this->token = $token;
        }

        return $this;
    }

    /**
     * Set response format
     *
     * @param $format
     * @throws BaseException
     * @return $this
     */
    public function setFormat($format): ImeiDBClient
    {
        if (!in_array($format, $this->getFormats())) {
            throw new BaseException('Format not supported');
        } else {
            $this->format = $format;
        }

        return $this;
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
     *
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getBalance($options = []): ResponseInterface
    {
        return $this->client->get('https://imeidb.xyz/api/balance', $options);
    }

    /**
     * Decode imei
     *
     * @param $imei
     * @param array $options
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getDecode($imei, $options = []): ResponseInterface
    {
        return $this->client->get("https://imeidb.xyz/api/imei/", array_replace_recursive($options, [
            'query' => [
                'imei' => $imei
            ]
        ]));
    }
}
