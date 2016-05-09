<?php

namespace PicodiLab\Expertsender\Method;

use GuzzleHttp\Psr7\Response;
use PicodiLab\Expertsender\Mapper;

class Messages extends AbstractMethod
{
    const METHOD_MESSAGES = 'Messages';

    protected $mapperName = 'Messages';

    public function getList()
    {
        $response = $this->connection->get(self::METHOD_MESSAGES, [
            'apiKey' => $this->connection->getKey(),
        ]);

        $this->connection->isResponseValid($response);
        $rXml = $this->connection->prepareResponse($response);

        $messages = [];
        foreach($rXml->Data->Messages[0] as $message)
        {
            $messages[] = new Mapper\Message(isset($message) ? (array)$message : []);
        }

        return $messages;
    }

    public function getMessage($id)
    {
        $response = $this->connection->get(self::METHOD_MESSAGES . '/' . $id, [
            'apiKey' => $this->connection->getKey(),
        ]);

        $this->connection->isResponseValid($response);
        $rXml = $this->connection->prepareResponse($response);

        return new Mapper\Message(isset($rXml->Data) ? (array)$rXml->Data : []);
    }
}