<?php

namespace PicodiLab\Expertsender\Mapper;

class Activity extends MapperAbstract
{

    protected $date = null;
    protected $email = null;
    protected $messageId = null;
    protected $messageSubject = null;
    protected $title = null;
    protected $url = null;
    protected $listId = null;
    protected $listName = null;
    protected $messageGuid = null;
    protected $type = null;

    const TYPE_CLICK = 'Clicks';
    const TYPE_SEND = 'Sends';
    const TYPE_OPEN = 'Opens';
    const TYPE_SUBSCRIPTION = 'Subscriptions';
    const TYPE_CONFIRMATION = 'Confirmations';
    const TYPE_COMPLAINT = 'Complaints';
    const TYPE_REMOVAL = 'Removals';
    const TYPE_BOUNCE = 'Bounces';
    const TYPE_GOAL = 'Goals';

    /**
     * @return null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null $Type
     */
    public function setType($Type)
    {
        $this->type = $Type;
    }


    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $Date
     * @return Activity
     */
    public function setDate($Date)
    {
        $this->date = $Date;
        return $this;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $Email
     * @return Activity
     */
    public function setEmail($Email)
    {
        $this->email = $Email;
        return $this;
    }

    /**
     * @return null
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @param null $MessageId
     * @return Activity
     */
    public function setMessageId($MessageId)
    {
        $this->messageId = $MessageId;
        return $this;
    }

    /**
     * @return null
     */
    public function getMessageSubject()
    {
        return $this->messageSubject;
    }

    /**
     * @param null $MessageSubject
     * @return Activity
     */
    public function setMessageSubject($MessageSubject)
    {
        $this->messageSubject = $MessageSubject;
        return $this;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null $Url
     * @return Activity
     */
    public function setUrl($Url)
    {
        $this->url = $Url;
        return $this;
    }

    /**
     * @return null
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param null $ListId
     * @return Activity
     */
    public function setListId($ListId)
    {
        $this->listId = $ListId;
        return $this;
    }

    /**
     * @return null
     */
    public function getListName()
    {
        return $this->listName;
    }

    /**
     * @param null $ListName
     * @return Activity
     */
    public function setListName($ListName)
    {
        $this->listName = $ListName;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageGuid()
    {
        return $this->messageGuid;
    }

    /**
     * @param null $MessageGuid
     * @return Activity
     */
    public function setMessageGuid($MessageGuid)
    {
        $this->messageGuid = $MessageGuid;
        return $this;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = (string)(trim($title));
        return $this;
    }


    /**
     * returns activity type in singular form
     * @param string $type
     * @return string
     */
    public function singularizeType($type)
    {
        return substr($type, 0, -1);
    }

}