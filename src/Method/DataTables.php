<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Exception\MethodInMapperNotFound;
use PicodiLab\Expertsender\Mapper;

class DataTables extends AbstractMethod
{

    const METHOD_DataTablesGetTables = 'DataTablesGetTables';
    const METHOD_DataTablesGetData = 'DataTablesGetData';
    const METHOD_DataTablesGetDataCount = 'DataTablesGetDataCount';
    const METHOD_DataTablesClearTable = 'DataTablesClearTable';
    const METHOD_DataTablesAddRow = 'DataTablesAddRow';
    const METHOD_DataTablesUpdateRow = 'DataTablesUpdateRow';
    const METHOD_DataTablesDeleteRow = 'DataTablesDeleteRow';

    const ORDERBY_DIRECTION_ASC = 'Ascending';
    const ORDERBY_DIRECTION_DESC = 'Descending';

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

        $this->connection->isResponseValid($response);

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

        $this->connection->isResponseValid($response);

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

        $this->connection->isResponseValid($response);

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

        $this->connection->isResponseValid($response);

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

        $this->connection->isResponseValid($response);

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

        $ok = $this->connection->isResponseValid($response);

        return (boolean)$ok;
    }

    /**
     * adds multiple rows to data table
     * @param $tableName
     * @param array $rows
     * @return bool
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

        $ok = $this->connection->isResponseValid($response);

        return (boolean)$ok;
    }

    
    public function asObject($input)
    {
        return $this->asArray($input); // no object type supported here.
    }


}