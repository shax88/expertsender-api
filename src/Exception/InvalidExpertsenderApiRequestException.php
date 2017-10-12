<?php


namespace PicodiLab\Expertsender\Exception;


class InvalidExpertsenderApiRequestException extends \Exception
{
    protected $request = null;

    public function setRequestBody($request)
    {
        $this->request = $request;
    }

    public function getRequestBody()
    {
        return $this->request;
    }
}