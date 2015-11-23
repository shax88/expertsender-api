<?php

namespace desher\expertsender\mappers;

class Subscriber
{
    public $id;
    public $ip;
    public $inBlackList;

    public $properties = [];
    public $lists = [];

    public function __construct($data)
    {
        if (isset($data->Data->Id)) {
            $this->setId($data->Data->Id);
        }
        if (isset($data->Data->Ip)) {
            $this->setIp($data->Data->Ip);
        }
        if (isset($data->Data->BlackList)) {
            $this->setInBlackList($data->Data->BlackList);
        }
        if (isset($data->Data->Properties)) {
            $this->setProperties($data->Data->Properties->Property);
        }
        if (isset($data->Data->StateOnLists)) {
            $this->setLists($data->Data->StateOnLists->StateOnList);
        }
    }

    public function setId($value)
    {
        $this->id = (int) $value;
    }

    public function setIp($value)
    {
        $this->ip = (string) $value;
    }

    public function setInBlackList($value)
    {
        $value = (string) $value;
        if ($value == 'true') {
            $this->inBlackList = true;
        } else {
            $this->inBlackList = false;
        }
    }

    public function setProperties($values)
    {
        foreach ($values as $property) {
            $this->properties[] = (array) $property;
        }
    }

    public function setLists($values)
    {
        foreach ($values as $list) {
            $this->lists[] = (array) $list;
        }
    }
}