<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Exception\MethodInMapperNotFound;
use PicodiLab\Expertsender\mappers;

class Tables extends AbstractMethod
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


//    /**
//     * Add a row to table
//     * @param $tableName
//     * @param $rowData
//     * @return bool
//     */
//    public function addRow($tableName, $rowData)
//    {
//        $result = $this->connection->post('DataTablesAddRow', $this->getRowXml($tableName, $rowData));
//        return $result['code'] === 204;
//    }

    /**
     * Delete row from datble
     * @param $tableName
     * @param array $rowData
     * @return bool
     */
    public function deleteRow($tableName, $rowData)
    {
        $xml = $this->connection->getDefaultRequestXml();
        $xml->addChild('TableName', $tableName);
        $pkColumns = $xml->addChild('PrimaryKeyColumns');
        foreach ($rowData as $columnName => $columnValue) {
            $columnXml = $pkColumns->addChild('Column');
            $columnXml->addChild('Name', $columnName);
            $columnXml->addChild('Value', $columnValue);
        }
        $result = $this->connection->post('DataTablesDeleteRow', $xml);
        return $result['code'] === 201;
    }

    /**
     * Find rows by condition
     * @param $tableName
     * @param array $selectColumns columns in result, ex. ['email', 'dog', 'age']
     * @param array $conditions , ex.:
     *  [
     *      ['ColumnName' =>'email', 'Operator' => 'Equals', 'Value' => 'test@text.test'],
     *      ['ColumnName' => 'dog', 'Operator' => 'Equals', 'Value' => 'beagle']
     *  ]
     * @return array
     * @throws Exception
     */
    public function getRows($tableName, $selectColumns, Array $conditions = [])
    {
        $xml = $this->connection->getDefaultRequestXml();
        $xml->addChild('TableName', $tableName);
        $columnsXml = $xml->addChild('Columns');
        foreach ($selectColumns as $columnName) {
            $columnsXml->addChild('Column', $columnName);
        }
        if (!empty($conditions)) {
            $conditionXml = $xml->addChild('WhereConditions');
            foreach ($conditions as $where) {
                $whereXml = $conditionXml->addChild('Where');
                $whereXml->addChild('ColumnName', $where['ColumnName']);
                $whereXml->addChild('Operator', $where['Operator']);
                $whereXml->addChild('Value', $where['Value']);
            }
        }

        $result = $this->connection->post('DataTablesGetData', $xml, false);

        if (!$result['code'] === 200) {
            throw new Exception('Tables row request error');
        }
        $lines = explode(PHP_EOL, trim($result['response']));
        unset($lines[0]);
        $data = [];
        foreach ($lines as $line) {
            $data[] = str_getcsv($line, ',', "\r\n");
        }
        return $data;
    }

    protected function getRowXml($tableName, $rowData)
    {
        $xml = $this->connection->getDefaultRequestXml();
        $xml->addChild('TableName', $tableName);

        $dataXml = $xml->addChild('Data');
        $columnsXml = $dataXml->addChild('Columns');

        foreach ($rowData as $columnName => $columnValue) {
            $columnXml = $columnsXml->addChild('Column');
            $columnXml->addChild('Name', $columnName);
            $columnXml->addChild('Value', $columnValue);
        }

        return $xml;
    }


    // ------------------------------- PicodiLab

    /**
     * performs DataTablesGetData Api request
     * @param $tableName
     * @param array $params
     * @param string $format
     * @return mixed
     * @throws InvalidExpertsenderApiRequestException
     */
    public function doDataTablesGetData($tableName, Array $params = [], $format = 'csv')
    {
        $defaultParams = [
            'Columns' => [],
            'Where' => [],
            'OrderBy' => '',
            'Limit' => [],
        ];

        $params = array_merge($defaultParams, $params);

        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesGetData);
        $requestBody = $this->render('Tables/DataTablesGetData', array_merge($params, [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $this->connection->isResponseValid($response);

        return $response->getBody();
    }

    /**
     * adds single row to data table
     * @param $tableName
     * @param array $row
     */
    public function addRow($tableName, Array $row)
    {

        $requestUrl = $this->buildApiUrl(self::METHOD_DataTablesAddRow);
        $requestBody = $this->render('Tables/DataTablesAddRow', array_merge(['Data' => $row], [
            'tableName' => $tableName,
            'apiKey' => $this->connection->getKey(),
        ]));

        $response = $this->connection->post($requestUrl, $requestBody);

        $ok = $this->connection->isResponseValid($response);

        return (boolean)$ok;
    }

    public function doDataTablesAddRowMultiple($tableName, Array $params)
    {

    }
}