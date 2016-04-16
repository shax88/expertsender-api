<?php

namespace PicodiLab\Expertsender\Mapper;

class Segment extends MapperAbstract{

    protected $id;
    protected $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Segment
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
     * @param mixed $name
     * @return Segment
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



}