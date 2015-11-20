<?php

namespace desher\expertsender;

use desher\expertsender\methods;

class ExpertSenderApi
{
    protected $connection;
    protected $sections = [];

    public function __construct($apiKey, $apiUrl = null)
    {
        $this->connection = new ExpertSenderApiConnection($apiKey, $apiUrl);
    }

    /**
     * @return methods\Subscribers
     */
    public function getSubscribers()
    {
        return $this->getApiSection('subscribers');
    }

    protected function getApiSection($name)
    {
        $className = ucfirst($name);
        if (!$this->sections[$name]) {
            $classFullName = 'methods\\' . $className;
            return $this->sections[$name] = new $classFullName($this->connection);
        }
        return $this->sections[$name];
    }
}