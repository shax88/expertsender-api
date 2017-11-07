<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Exception\MethodInMapperNotFound;
use PicodiLab\Expertsender\Mapper;

class DataTables extends AbstractMethod
{

    const METHOD_DataTablesGetTables    = 'DataTablesGetTables';
    const METHOD_DataTablesGetData      = 'DataTablesGetData';
    const METHOD_DataTablesGetDataCount = 'DataTablesGetDataCount';
    const METHOD_DataTablesClearTable   = 'DataTablesClearTable';
    const METHOD_DataTablesAddRow       = 'DataTablesAddRow';
    const METHOD_DataTablesUpdateRow    = 'DataTablesUpdateRow';
    const METHOD_DataTablesDeleteRow    = 'DataTablesDeleteRow';
    const METHOD_ImportToDataTableTasks = 'ImportToDataTableTasks';

    const ORDERBY_DIRECTION_ASC  = 'Ascending';
    const ORDERBY_DIRECTION_DESC = 'Descending';

    const IMPORT_MODE_ADD     = 'Add';
    const IMPORT_MODE_REPLACE = 'Replace';

    protected $mapperName = 'DataTable';


    /**
     * clears given data table
     * @param $tableName
     * @return bool
     * @throws InvalidExpertsenderApiRequestException
     * @throws MethodInMapperNotFoundException
     */
    public function clearTable($tableName)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesClearTable);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesClearTable', [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]);

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        return (boolean)$response->getBody();
    }

    /**
     * Delete row from data table
     * @param $tableName
     * @param array $conditions
     * @return bool
     */
    public function deleteRow($tableName, Array $conditions)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesDeleteRow);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesDeleteRow', array_merge(['conditions' => $conditions], [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);
        if (!$valid) {
            $this->invalidRequestException();
        }

        return (boolean)$response->getBody();
    }


    /**
     * Updates single row in data table
     * @param $tableName
     * @param array $conditions
     * @return bool
     */
    public function updateRow($tableName, Array $data, Array $conditions)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesUpdateRow);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesUpdateRow', array_merge(
            ['conditions' => $conditions],
            ['data' => $data],
            [
                'tableName' => $tableName,
                'apiKey' => $this->connection->getKey(),
            ]
        ));

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        return (boolean)$response->getBody();
    }

    /**
     * performs DataTablesGetData Api request
     * @param $tableName
     * @param array $params
     * @param string $format
     * @return mixed
     * @throws InvalidExpertsenderApiRequestException
     */
    public function getData($tableName, Array $params = [], $format = 'csv')
    {
        $defaultParams = [
            'Columns' => [],
            'Where' => [],
            'OrderBy' => '',
            'Limit' => [],
        ];

        $params = array_merge($defaultParams, $params);

        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesGetData);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesGetData', array_merge($params, [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        return $this->formatResponse($response);
    }


    /**
     * performs DataTablesGetDataCount - counts data table rows
     * @param $tableName
     * @param array $params
     * @param string $format
     * @return mixed
     * @throws InvalidExpertsenderApiRequestException
     */
    public function getDataCount($tableName, Array $conditions = [])
    {

        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesGetDataCount);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesGetDataCount', array_merge(['conditions' => $conditions], [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $rXml = $this->connection->prepareResponse($response);
        $cnt = (int)$rXml->xpath('//Count')[0];

        return $cnt;
    }

    /**
     * adds single row to data table
     * @param $tableName
     * @param array $row
     */
    public function addRow($tableName, Array $row)
    {

        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesAddRow);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesAddRow', array_merge(['Data' => $row], [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
    }

    /**
     * adds multiple rows to data table
     * @param $tableName
     * @param array $rows
     * @throws InvalidExpertsenderApiRequestException
     * @throws MethodInMapperNotFoundException
     */
    public function addRows($tableName, Array $rows)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesAddRow);
        $requestBody = $this->renderRequestBody('DataTables/DataTablesAddRowMultiData', array_merge(['MultiData' => $rows], [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }
    }

    /**
     * Create import task to data table
     *
     * @param string $url
     * @param string $targetName
     * @param string $user
     * @param string $password
     * @param array  $settings
     *
     * @return int ID of Task
     */
    public function importFileTask($url, $targetName, $user = null, $password = null, $settings = [])
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_ImportToDataTableTasks);

        $defaultSettings = [
            'mode'         => self::IMPORT_MODE_ADD,
            'delimiter'    => ',',
            'quote'        => '"',
            'escape'       => '"',
            'comment'      => ' ',
            'encoding'     => 'UTF-8',
            'startingLine' => 0,
        ];
        $settings = array_merge($defaultSettings, $settings);
        $requestBody = $this->renderRequestBody(
            'DataTables/ImportToDataTableTasks',
            [
                'apiKey'   => $this->connection->getKey(),
                'url'      => $url,
                'user'     => $user,
                'password' => $password,
                'target'   => $targetName,
                'settings' => $settings,
            ]
        );

        $response = $this->connection->post($requestUrl, $requestBody);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $formattedResponse = $this->connection->prepareResponse($response);

        return (int)$formattedResponse->Data[0];
    }

    /**
     * Retunrs data table import status
     *
     * @param int $id
     *
     * @return Mapper\DataTableImportStatus
     */
    public function importTaskStatus($id)
    {
        $requestUrl = $this->buildApiUrl(self::METHOD_ImportToDataTableTasks);
        $requestUrl .= '/' . $id;

        $params = [
            'apiKey'      => $this->connection->getKey(),
            'http_errors' => false,
            'query'       => [],
        ];

        $response = $this->connection->get($requestUrl, $params);

        $valid = $this->connection->isResponseValid($response);

        if (!$valid) {
            $this->invalidRequestException();
        }

        $formattedResponse = $this->connection->prepareResponse($response);

        $mapperStatus = new \PicodiLab\Expertsender\Mapper\DataTableImportStatus();
        $mapperHistory = new \PicodiLab\Expertsender\Mapper\DataTableImportStatusHistory();
        $mapperStatus->setName((string)$formattedResponse->Data->Status);
        $mapperStatus->setUrl((string)$formattedResponse->Data->Status);
        $mapperStatus->setHistory($mapperHistory);

        $importData = $formattedResponse->Data->History->Import[0];
        $mapperHistory->setStatus((string)$importData->Status);
        $mapperHistory->setStartedAt((string)$importData->StartedAt);
        $mapperHistory->setUpdatedAt((string)$importData->UpdatedAt);
        $mapperHistory->setDetails((string)$importData->Details);
        return $mapperStatus;
    }


    public function asObject($input)
    {
        return $this->asArray($input); // no object type supported here.
    }

}