<?php

namespace PicodiLab\Expertsender\Mapper;

class DataTable extends MapperAbstract
{

    protected $id;
    protected $name;

    /**
     * there should be some data mapping also here.
     */

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