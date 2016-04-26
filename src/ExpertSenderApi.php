<?php

namespace AppBundle\PicodiLab;

class ExpertSenderApi
{
    /**
     * @var ExpertSenderApiConnection
     */
    protected $connection;

    /**
     * @var array
     */
    protected $sections = [];

    /**
     * @var array
     */
    protected $customFields = [];

    public function __construct($apiKey, $apiUrl = null)
    {
        $this->connection = new ExpertSenderApiConnection($apiKey, $apiUrl);
    }

    public function prepareBusinessUnit(){
        $this->customFields = $this->Fields()->setOutputFormat('ARRAY')->get();
    }

    /**
     * @return \AppBundle\PicodiLab\Method\Subscribers
     */
    public function Subscribers()
    {
        return $this->getApiSection('subscribers');
    }

    /**
     * @return \AppBundle\PicodiLab\Method\DataTables
     */
    public function DataTables()
    {
        return $this->getApiSection('dataTables');
    }

    /**
     * @return \AppBundle\PicodiLab\Method\Lists
     */
    public function Lists()
    {
        return $this->getApiSection('lists');
    }

    /**
     * @return \AppBundle\PicodiLab\Method\Goals
     */
    public function Goals()
    {
        return $this->getApiSection('goals');
    }

    /**
     * @return \AppBundle\PicodiLab\Method\Activities
     */
    public function Activities()
    {
        return $this->getApiSection('activities');
    }

    /**
     * @return \AppBundle\PicodiLab\Method\Statistics
     */
    public function Statistics()
    {
        return $this->getApiSection('statistics');
    }

    /**
     * @return \AppBundle\PicodiLab\Method\Fields
     */
    public function Fields()
    {
        return $this->getApiSection('fields');
    }

    /**
     * @return \AppBundle\PicodiLab\Expertsender\Method\Segments
     */
    public function Segments()
    {
        return $this->getApiSection('segments');
    }


    /**
     * @return ExpertSenderApiConnection
     */
    public function getConnection(){
        return $this->connection;
    }

    /**
     * @param $name
     * @return mixed instance of specified section
     */
    protected function getApiSection($name)
    {
        $className = ucfirst($name);
        if (!isset($this->sections[$name])) {
            $classFullName = 'AppBundle\\PicodiLab\\Method\\' . $className; // TODO repair if we use composer
            return $this->sections[$name] = new $classFullName($this->connection);
        }
        return $this->sections[$name];
    }


}