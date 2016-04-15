<?php

namespace PicodiLab\Expertsender;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ExpertSenderApiConnection
{
    /** @var string api url */
    protected $url = 'https://api2.esv2.com/Api/';

    /** @var  string api key */
    protected $key;

    /** @var Client */
    protected $httpClient;

    public function __construct($key, $url)
    {
        $this->key = $key;

        if ($url) {
            $this->url = $url;
        }

        $this->httpClient = new Client(['base_uri' => $this->url]);
    }

    /**
     * gets the API URL
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * gets the API key
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * GET request
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

        return ['code' => $response->getStatusCode(), 'response' => $this->prepareResponse($response)];
    }

    /**
     * POST method
     * @param $method
     * @param $requestBody
     * @return array
     */
    public function post($method, $requestBody, $prepareResonse = false)
    {

        $request = new Request('POST', $method, ['content-type' => 'text/xml'], $requestBody);
        $response = $this->httpClient->send($request, ['http_errors' => false]);


        return $response;

    }

    /**
     * Add child SimpleXMLElement to parent SimpleXMLElement
     *
     * @param \SimpleXMLElement $parent
     * @param \SimpleXMLElement $child
     * @return \SimpleXMLElement
     */
    public function addChildSimpleXml(\SimpleXMLElement $parent, \SimpleXMLElement $child)
    {
        $toDom = dom_import_simplexml($parent);
        $fromDom = dom_import_simplexml($child);
        $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
        return $parent;
    }

    /**
     * Convert response to object
     * @param Response $response
     * @return \SimpleXMLElement
     */
    public function prepareResponse(Response $response)
    {
        $responseBody = (string)$response->getBody();
        if ($responseBody) {
            return simplexml_load_string($responseBody);
        }
        return null;
    }

    /**
     * Return default xml object (wrapper) for post and put requests
     * @return \SimpleXMLElement
     */
    public function getDefaultRequestXml()
    {
        $xmlObject = new \SimpleXMLElement('<ApiRequest xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xs="http://www.w3.org/2001/XMLSchema" />');
        $xmlObject->addChild('ApiKey', $this->key);
        return $xmlObject;
    }
}