<?php

namespace desher\expertsender;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class ExpertSenderApiConnection
{
    /** @var string api url  */
    private $url = 'https://api2.esv2.com/Api/';

    /** @var  string api key */
    private $key;

    /** @var Client  */
    private $httpClient;

    public function __construct($key, $url)
    {
        $this->key = $key;

        if ($url) {
            $this->url = $url;
        }

        $this->httpClient = new Client(['base_uri' => $this->url]);
    }

    /**
     * GET request to api
     * @param $method
     * @param array $data
     * @return array
     */
    public function get($method, array $data)
    {
        $data['apiKey'] = $this->key;

        $response = $this->httpClient->request('GET', $method, [
            'query' => $data,
            'http_errors' => false,
        ]);

        return $this->prepareResponse($response);
    }

    public function post($method, array $data)
    {
        $data['apiKey'] = $this->key;

        $response = $this->httpClient->request('POST', $method, [
            'query' => $data,
            'http_errors' => false,
        ]);

        return $this->prepareResponse($response);
    }

    /**
     * Convert response to object
     * @param Response $response
     * @return \SimpleXMLElement
     */
    public function prepareResponse(Response $response)
    {
        return simplexml_load_string((string) $response->getBody());
    }
}