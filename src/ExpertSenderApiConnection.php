<?php

namespace desher\expertsender;

use GuzzleHttp\Client;

class ExpertSenderApiConnection
{
    /** @var string api url  */
    private $url = 'https://api2.esv2.com';

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

        $this->httpClient = new Client();
    }

    public function get($method, array $data)
    {
        $response = $this->httpClient->request('GET', $this->getMethodUrl($method), $this->getPreparedData($data));
        return $response;
    }

    protected function getMethodUrl($method)
    {
        return "{$this->url}/Api/{$method}";
    }

    protected function getPreparedData(array $data)
    {
        $data['apiKey'] = $this->key;
        return $data;
    }
}