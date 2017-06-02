<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Exception\MethodInMapperNotFoundException;
use PicodiLab\Expertsender\Mapper;

class Goals extends AbstractMethod
{

    const METHOD_Goals = 'Goals';

    protected $mapperName = 'Goal';

    /**
     * fulfils the given goal through Api request
     * @param Mapper\Goal $goal
     * @throws MethodInMapperNotFoundException
     * @throws InvalidExpertsenderApiRequestException
     */
    public function fulfil(Mapper\Goal $goal)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_Goals);

        $requestBody = $this->renderRequestBody('Goals/Goals', [
            'Goal' => $goal,
            'apiKey' => $this->connection->getKey(),
        ]);

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
    }

}