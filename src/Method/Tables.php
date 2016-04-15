<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Exception\InvalidExpertsenderApiRequestException;
use PicodiLab\Expertsender\Exception\MethodInMapperNotFound;
use PicodiLab\Expertsender\mappers;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use yii\base\Exception;

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


    public function buildApiUrl($method)
    {
//        $refl = new \ReflectionClass(__CLASS__);
//        $availableMethods = preg_grep('/^METHOD_/', array_flip($refl->getConstants()));
//
//        $const = null;
//        if(!array_key_exists($method, $availableMethods)){
//            throw new MethodInMapperNotFoundException('Method ' . $method . ' not found in \Mapper\Tables');
//        }
//        else{
//            $const = 'METHOD_' . $method;
//        }


        $apiRequestUrl = $this->connection->getUrl() . $method;
        return $apiRequestUrl;
    }

    /**
     * Add a row to table
     * @param $tableName
     * @param $rowData
     * @return bool
     */
    public function addRow($tableName, $rowData)
    {
        $result = $this->connection->post('DataTablesAddRow', $this->getRowXml($tableName, $rowData));
        return $result['code'] === 204;
    }

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


    public function doDataTablesGetData($tableName, Array $params = [])
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

        if($response->getStatusCode() != 200){
            throw new InvalidExpertsenderApiRequestException();
        }

        return $response->getBody();
    }
}