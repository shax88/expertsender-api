<?php

namespace PicodiLab\Expertsender\Method;

use GuzzleHttp\Psr7\Response;
use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Exception\MethodInMapperNotFoundException;
use PicodiLab\Expertsender\Mapper;
use PicodiLab\Expertsender\Mapper\Activity;

class Activities extends AbstractMethod
{

    const METHOD_Activities = 'Activities';

    protected $mapperName = 'Activity';

    /**
     *
     * get subscriber activities
     *
     * @param $type
     * @param $date
     * @param array $params
     * @param string $format
     * @return string
     * @throws InvalidExpertsenderApiRequestException
     * @throws \PicodiLab\Expertsender\Method\MethodInMapperNotFoundException
     */
    public function get($type, $date, $params = [])
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_Activities);

        $defaultParams = [
            'apiKey' => $this->connection->getKey(),
            'date' => $date, //validate ?
            'type' => $type, //validate ?
            'http_errors' => false,
            'returnGuid' => 'true',
            'columns' => 'Extended',
            'returnTitle' => 'true'
        ];
        if (isset($params['returnTitle']) && is_bool($params['returnTitle'])) {
            $params['returnTitle'] = ($params['returnTitle'] ? 'true' : 'false');
        }
        if (isset($params['returnGuid']) && is_bool($params['returnGuid'])) {
            $params['returnGuid'] = ($params['returnGuid'] ? 'true' : 'false');
        }
        $params = array_merge($defaultParams, $params);
        $response = $this->connection->get($requestUrl, $params);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        return $this->formatResponse($response);
    }






}