<?php

namespace PicodiLab\Expertsender\Mapper;

class SubscribersList extends MapperAbstract
{
    protected $id;
    protected $name;
    protected $friendlyName;
    protected $language;
    protected $optInMode;

    public function setLanguage($language){
        $this->language = $language;
        return $this;
    }

    public function getLanguage()
    {
        return $this->language;
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
     * @return SubscribersList
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $friendlyName
     * @return SubscribersList
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }

    /**
     * @param mixed $friendlyName
     * @return SubscribersList
     */
    public function setFriendlyName($friendlyName)
    {
        $this->friendlyName = $friendlyName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptInMode()
    {
        return $this->optInMode;
    }

    /**
     * @param mixed $optInMode
     * @return SubscribersList
     */
    public function setOptInMode($optInMode)
    {
        $this->optInMode = $optInMode;
        return $this;
    }


}