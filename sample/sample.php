<?php

require '../vendor/autoload.php';


$expertsender = new \desher\Expertsender\ExpertSenderApi('');

$tables = $expertsender->getTables();



