<?php

namespace desher\expertsender\methods;

use desher\expertsender\ExpertSenderApiConnection;

abstract class AbstractMethod
{
    /** @var ExpertSenderApiConnection  */
    protected $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }
}