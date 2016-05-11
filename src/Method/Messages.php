<?php

namespace PicodiLab\Expertsender\Method;

use GuzzleHttp\Psr7\Response;
use PicodiLab\Expertsender\Mapper;

class Messages extends AbstractMethod
{
    const METHOD_MESSAGES = 'Messages';

    protected $mapperName = 'Messages';

    public function getList($options = null)
    {
        $_options = [
            'apiKey' => $this->connection->getKey(),
        ];
        if($options && is_array($options))
        {
            $_options = array_merge($options, $_options);
        }

        $response = $this->connection->get(self::METHOD_MESSAGES, $_options);

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