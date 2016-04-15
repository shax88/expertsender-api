<?php

namespace PicodiLab\Expertsender\Mapper;

class SubscribersList
{
    protected $name;
    protected $language;

    function __construct($name, $language = 'ru-RU')
    {
        $this->name = $name;
        $this->language = $language;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLanguage()
    {
        return $this->language;
    }

}