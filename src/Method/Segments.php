<?php

namespace PicodiLab\Expertsender\Method;


use PicodiLab\Expertsender\ResponseFormatter\XmlBased;

class Segments extends AbstractMethod
{

    use XmlBased;

    const METHOD_Segments = 'Segments';

    protected $mapperName = 'Segment';


    public function get()
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_Segments);

        $response = $this->connection->get($requestUrl, []);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        return $this->formatResponse($response);
    }

}