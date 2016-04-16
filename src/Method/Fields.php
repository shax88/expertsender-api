<?php

namespace PicodiLab\Expertsender\Method;


use PicodiLab\Expertsender\ResponseFormatter\XmlBased;

class Fields extends AbstractMethod
{

    use XmlBased;

    const METHOD_Fields = 'Fields';

    protected $mapperName = 'Field';



    public function get()
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_Fields);
        $response = $this->connection->get($requestUrl, []);
        $this->connection->isResponseValid($response);

        return $this->formatResponse($response);
    }

}