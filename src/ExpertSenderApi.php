<?php

namespace PicodiLab\Expertsender;

class ExpertSenderApi
{
    protected $connection;
    protected $sections = [];

    protected $customFields = [];

    public function __construct($apiKey, $apiUrl = null)
    {
        $this->connection = new ExpertSenderApiConnection($apiKey, $apiUrl);
    }

    public function prepareBusinessUnit(){
        $this->customFields = $this->Fields()->setOutputFormat('ARRAY')->get();
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Subscribers
     */
    public function Subscribers()
    {
        return $this->getApiSection('subscribers');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\DataTables
     */
    public function DataTables()
    {
        return $this->getApiSection('dataTables');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Lists
     */
    public function Lists()
    {
        return $this->getApiSection('lists');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Goals
     */
    public function Goals()
    {
        return $this->getApiSection('goals');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Activities
     */
    public function Activities()
    {
        return $this->getApiSection('activities');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Statistics
     */
    public function Statistics()
    {
        return $this->getApiSection('statistics');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Fields
     */
    public function Fields()
    {
        return $this->getApiSection('fields');
    }

    /**
     * @return \PicodiLab\Expertsender\Method\Segments
     */
    public function Segments()
    {
        return $this->getApiSection('segments');
    }

    /**
     * @param $name
     * @return mixed instance of specified section
     */
    protected function getApiSection($name)
    {
        $className = ucfirst($name);
        if (!isset($this->sections[$name])) {
            $classFullName = 'PicodiLab\\Expertsender\\Method\\' . $className;
            return $this->sections[$name] = new $classFullName($this->connection);
        }
        return $this->sections[$name];
    }


}