<?php

namespace PicodiLab\Expertsender\Mapper;

class Goal
{
    protected $id;
    protected $value;
    protected $messageGuid;

    function __construct($id, $value, $messageGuid = null)
    {
        $this->id = $id;
        $this->value = $value;
        $this->messageGuid = $messageGuid;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Goal
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Goal
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return null
     */
    public function getMessageGuid()
    {
        return $this->messageGuid;
    }

    /**
     * @param null $messageGuid
     * @return Goal
     */
    public function setMessageGuid($messageGuid)
    {
        $this->messageGuid = $messageGuid;
        return $this;
    }

}