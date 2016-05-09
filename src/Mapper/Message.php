<?php

namespace PicodiLab\Expertsender\Mapper;

use PicodiLab\Expertsender\Method\Fields;

class Message
{
    protected $id;
    protected $fromName;
    protected $fromEmail;
    protected $subject;
    protected $type;
    protected $sentDate;
    protected $tags;

    /**
     * @param mixed $data
     */
    public function __construct($data = [])
    {
        if (isset($data['Id'])) {
            $this->setId($data['Id']);
        }
        if (isset($data['FromName'])) {
            $this->setFromName($data['FromName']);
        }
        if (isset($data['FromEmail'])) {
            $this->setFromEmail($data['FromEmail']);
        }
        if (isset($data['Subject'])) {
            $this->setSubject($data['Subject']);
        }
        if (isset($data['Type'])) {
            $this->setType($data['Type']);
        }
        if (isset($data['SentDate'])) {
            $this->setSentDate($data['SentDate']);
        }
        if (isset($data['Tags'])) {
            $this->setTags($data['Tags']);
        }
    }

    public function setId($value)
    {
        $this->id = (int)$value;
        return $this;
    }

    public function setFromName($value)
    {
        $this->fromName = $value;
        return $this;
    }

    public function setFromEmail($value)
    {
        $this->fromEmail = $value;
        return $this;
    }

    public function setSubject($value)
    {
        $this->subject = $value;
        return $this;
    }

    public function setType($value)
    {
        $this->type = $value;
        return $this;
    }

    public function setSentDate($value)
    {
        $this->sentDate = $value;
        return $this;
    }

    public function setTags($value)
    {
        $this->tags = $value;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFromName()
    {
        return $this->fromName;
    }

    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getSentDate()
    {
        return $this->sentDate;
    }

    public function getTags()
    {
        return $this->tags;
    }
}