<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Mapper;
use PicodiLab\Expertsender\ResponseFormatter\XmlBased;

class Lists extends AbstractMethod
{

    use XmlBased;

    const METHOD_LISTS         = 'Lists';
    const METHOD_LISTS_EXPORTS = 'Exports';

    protected $mapperName = 'SubscribersList';

    /**
     * creates new subscriber list
     *
     * @param $name
     * @param array $params
     *
     * @return int list id
     * @throws InvalidExpertsenderApiRequestException
     * @throws MethodInMapperNotFoundException
     */
    public function create($name, $params = [])
    {

        $defaultParams = [
            'Name'         => $name,
            'FriendlyName' => null,
            'Description'  => null,
            'Language'     => null,
            'OptInMode'    => null,
            // ... not necessary now.
        ];

        $params = array_merge($defaultParams, $params);

        $requestUrl = $this->buildApiUrl(self::METHOD_LISTS);
        $requestBody = $this->renderRequestBody(
            'Lists/Lists',
            array_merge(
                ['settings' => $params],
                [
                    'apiKey' => $this->connection->getKey(),
                ]
            )
        );

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $response = $this->connection->prepareResponse($response);

        return (int)$response->Data;
    }

    /**
     * Gets subscribers lists
     *
     * @param array $params
     * @param bool $raw
     *
     * @return array
     * @throws MethodInMapperNotFoundException
     * @throws InvalidExpertsenderApiRequestException
     */
    public function get($params = [])
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_LISTS);

        $defaultParams = [
            'apiKey'      => $this->connection->getKey(),
            'http_errors' => false,
            'query'       => [],
        ];

        $params = array_merge($defaultParams, $params);
        $response = $this->connection->get($requestUrl, $params);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $this->outputFormat = self::FORMAT_OBJECT;

        return $this->formatResponse($response);
    }

}