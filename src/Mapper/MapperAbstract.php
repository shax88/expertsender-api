<?php

namespace PicodiLab\Expertsender\Mapper;

class MapperAbstract
{

    public function initialize(Array $properties)
    {
        foreach ($properties as $k => $v) {
            $methodName = trim('set' . ucfirst($k));
            $this->{$methodName}($v);
        }

        return $this;
    }
}