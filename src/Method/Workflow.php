<?php

namespace PicodiLab\Expertsender\Method;

use GuzzleHttp\Psr7\Response;
use PicodiLab\Expertsender\Mapper;

class Workflow extends AbstractMethod
{
    const METHOD_TRIGGER = 'WorkflowCustomEvents';

    public function triggerCustomEvent($id, $data = null, $email = null, $emailID = null)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_TRIGGER);

        $requestBody = $this->renderRequestBody('Workflow/Trigger', array_merge(['data' => $data], [
            'apiKey' => $this->connection->getKey(),
            'id' => $id,
            'email' => $email ? $email : null,
            'emailID' => $emailID ? $emailID : null
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);
        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
        $response = $this->connection->prepareResponse($response);
        return $response;
    }
}