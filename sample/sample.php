<?php

require '../vendor/autoload.php';


$expertsender = new \PicodiLab\Expertsender\ExpertSenderApi('kN8sqgkXHAVScanM6wms', 'https://api3.esv2.com/Api/');

$tables = $records = $expertsender->getTables();
//$buildUrl = $tables->buildApiUrl(\desher\Expertsender\Method\Tables::METHOD_DataTablesGetData);

//$records = $expertsender->getTables()->getRows('TR_Subscribers', ['email_id', 'email']);

$dataTables = $tables->doDataTablesGetData('TR_Subscribers', [
    'Columns' => ['email', 'email_id'],
//    'Where' => [
//        [
//            'ColumnName' => 'email',
//            'Operator' => 'Like',
//            'Value' => '1907tolga_-@windowslive.com'
//        ]
//    ],
    'OrderBy' => [
        'ColumnName' => 'email_id',
        'Direction' => \PicodiLab\Expertsender\Method\Tables::ORDERBY_DIRECTION_ASC
    ],
    'Limit' => 10
]);

echo $dataTables;



