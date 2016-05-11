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
    //protected $throttlingMethod;
    //protected $throttling;
    //protected $googleAnalyticsTags;
    //protected $tandexListId;
    //protected $channels;
    protected $lists;
    protected $segments;
    //protected $status;

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
        if (isset($data['Lists'])) {
            $this->setLists($data['Lists']);
        }
        if (isset($data['Segments'])) {
            if ($data['Segments'] instanceof \SimpleXMLElement) {
                $this->setSegments($data['Segments']->Segment);
            } else {
                $this->setSegments($data['Segments']);
            }
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

    public function setLists($value)
    {
        $this->lists = $value;
        return $this;
    }

    public function setSegments($values)
    {
        foreach ($values as $segment)
        {
            if(!empty($segment->Name)) {
                $name = trim($segment->Name);
                $this->segments[$name] = new Segment((array)$segment);
            }else{
                $this->segments[] = new Segment((array)$segment);
            }
        }
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

    public function getLists()
    {
        return $this->lists;
    }

    public function getSegments()
    {
        return $this->segments;
    }
}