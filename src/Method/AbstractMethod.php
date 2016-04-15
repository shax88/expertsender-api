<?php

namespace desher\Expertsender\Method;

use desher\Expertsender\ExpertSenderApiConnection;

abstract class AbstractMethod
{
    /** @var ExpertSenderApiConnection  */
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}