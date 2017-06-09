<?php

namespace PicodiLab\Expertsender\Mapper;

class Property extends Field
{

    /**
     * @var string
     */
    protected $source;

    /**
     * @var string
     */
    protected $defaultStringValue;

    /**
     * @var int
     */
    protected $defaultIntValue;

    /**
     * @var string
     */
    protected $defaultDateTimeValue;

    /**
     * @var float
     */
    protected $defaultDecimalValue;

    /**
     * @var string
     */
    protected $stringValue;

    /**
     * @var int
     */
    protected $intValue;

    /**
     * @var string
     */
    protected $dateTimeValue;

    /**
     * @var float
     */
    protected $decimalValue;


    public function setId($value)
    {
        $this->id = (int)$value;
    }


    public function setValue($value)
    {
        if ($this->type == self::TYPE_BOOLEAN) {
            $this->value = $value ? 'true' : 'false';
        } else {
            $this->value = $value;
        }
    }

    public function setIntValue($value)
    {
        $this->value = (int)$value;
    }

    public function setDecimalValue($value)
    {
        $this->value = floatval($value);
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return Property
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultStringValue()
    {
        return $this->defaultStringValue;
    }

    /**
     * @param string $defaultStringValue
     */
    public function setDefaultStringValue($defaultStringValue)
    {
        $this->defaultStringValue = (string)(trim($defaultStringValue));
        return $this;
    }

    /**
     * @return int
     */
    public function getDefaultIntValue()
    {
        return $this->defaultIntValue;
    }

    /**
     * @param int $defaultIntValue
     */
    public function setDefaultIntValue($defaultIntValue)
    {
        $this->defaultIntValue = $defaultIntValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getDefaultDateTimeValue()
    {
        return $this->defaultDateTimeValue;
    }

    /**
     * @param string $defaultDateTimeValue
     */
    public function setDefaultDateTimeValue($defaultDateTimeValue)
    {
        $this->defaultDateTimeValue = $defaultDateTimeValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getDefaultDecimalValue()
    {
        return $this->defaultDecimalValue;
    }

    /**
     * @param float $defaultDecimalValue
     */
    public function setDefaultDecimalValue($defaultDecimalValue)
    {
        $this->defaultDecimalValue = $defaultDecimalValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getStringValue()
    {
        return $this->stringValue;
    }

    /**
     * @param string $stringValue
     */
    public function setStringValue($stringValue)
    {
        $this->stringValue = (string)(trim($stringValue));
        return $this;
    }

    /**
     * @return string
     */
    public function getDateTimeValue()
    {
        return $this->dateTimeValue;
    }

    /**
     * @param string $dateTimeValue
     */
    public function setDateTimeValue($dateTimeValue)
    {
        $this->dateTimeValue = $dateTimeValue;
        return $this;
    }

    /**
     * Returns value for save
     * @return mixed
     */
    public function getSaveValue()
    {
        switch ($this->type) {
            case self::TYPE_STRING:
                return $this->stringValue;
            case self::TYPE_DATE_TIME:
                return $this->dateTimeValue;
            case self::TYPE_DATE_TIME:
                return $this->dateTimeValue;
            default :
                return $this->value;
        }
    }
}