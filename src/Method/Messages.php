<?php

namespace PicodiLab\Expertsender\Method;

use GuzzleHttp\Psr7\Response;
use PicodiLab\Expertsender\Mapper;
use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;

class Messages extends AbstractMethod
{
    const METHOD_MESSAGES = 'Messages';
    const METHOD_NEWSLLETER = 'Newsletters';
    const METHOD_TRANSACTIONAL_MESSAGE = 'Transactionals';
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

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
        
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

        $valid = $this->connection->isResponseValid($response);        if (!$valid) {            $this->invalidRequestException();        }
        $rXml = $this->connection->prepareResponse($response);

        return new Mapper\Message(isset($rXml->Data) ? (array)$rXml->Data : []);
    }

    public function setNewsletter($data){
        $requestUrl = $this->buildApiUrl(self::METHOD_NEWSLLETER);

        $requestBody = $this->renderRequestBody('Newsletters/Newsletters', array_merge(['data' => $data], [
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);
        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
        
        return $response;
    }

    public function stopNewsletter($id){

        $response = $this->connection->delete(self::METHOD_MESSAGES . '/' . $id, [
            'apiKey' => $this->connection->getKey(),
        ]);
        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
        $response = $this->connection->prepareResponse($response);
        return $response;
    }

    public function startNewsletter($id){
        $requestUrl = $this->buildApiUrl(self::METHOD_NEWSLLETER.'/'.$id);
        $requestBody = $this->renderRequestBody('Newsletters/ActionNewsletter', [
            'apiKey' => $this->connection->getKey(),
            'action' => 'ResumeMessage'
        ]);

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
        
        $response = $this->connection->prepareResponse($response);
        
        return $response;
    }

    public function sendTransactinalMessage($email, $params, $message_id, $returnGuid = true){
        $requestUrl = $this->buildApiUrl(self::METHOD_TRANSACTIONAL_MESSAGE);
        $requestUrl .= '/'.$message_id;
        
        $returnGuid = ($returnGuid ? 'true' : 'false');
        $requestBody = $this->renderRequestBody('Transactional/Message', [
            'apiKey'     => $this->connection->getKey(),
            'email'      => $email,
            'ReturnGuid' => $returnGuid,
            'params'     => $params
        ]);

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
        
        $response = $this->connection->prepareResponse($response);
        return $response;
    }
}