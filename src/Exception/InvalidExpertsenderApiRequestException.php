<?php


namespace PicodiLab\Expertsender\Exception;


class InvalidExpertsenderApiRequestException extends \Exception
{
    protected $request = null;
    protected $response = null;

    public function setRequestBody($request)
    {
        $this->request = $request;
    }

    public function getRequestBody()
    {
        return $this->request;
    }

    /**
     * @return string|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string|null $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }


}