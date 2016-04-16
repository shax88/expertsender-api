<?php

namespace PicodiLab\Expertsender\Mapper;


class Field extends MapperAbstract
{

    const TYPE_BOOLEAN = 'boolean';
    const TYPE_STRING = 'string';
    const TYPE_INTEGER = 'integer';
    const TYPE_DOUBLE = 'double';
    const TYPE_DATE = 'date';
    const TYPE_DATE_TIME = 'dateTime';


    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $friendlyName;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $defaultValue;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var boolean
     */
    protected $visible;

    /**
     * @var boolean
     */
    protected $required;

    function __construct(Array $data = [])
    {
        $this->initialize($data);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Field
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Field
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }

    /**
     * @param string $friendlyName
     * @return Field
     */
    public function setFriendlyName($friendlyName)
    {
        $this->friendlyName = $friendlyName;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Field
     */
    public function setType($value)
    {
        if ($value == 'Boolean') {
            $this->type = self::TYPE_BOOLEAN;
        }
        if ($value == 'Text') {
            $this->type = self::TYPE_STRING;
        }
        if ($value == 'Number') {
            $this->type = self::TYPE_DOUBLE;
        }
        if ($value == 'Money') {
            $this->type = self::TYPE_DOUBLE;
        }
        if ($value == 'Url') {
            $this->type = self::TYPE_STRING;
        }
        if ($value == 'Date') {
            $this->type = self::TYPE_DATE;
        }
        if ($value == 'Datetime') {
            $this->type = self::TYPE_DATE_TIME;
        }
        if ($value == 'SingleSelect') {
            $this->type = self::TYPE_STRING;
        }
        $this->type = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @param mixed $defaultValue
     * @return Field
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Field
     */
    public function setDescription($description)
    {
        $this->description = (string)(trim($description));
        return $this;
    }

    /**
     * @return boolean
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param boolean $visible
     * @return Field
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     * @return Field
     */
    public function setRequired($required)
    {
        $this->required = $required;
        return $this;
    }


}