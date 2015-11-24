<?php

namespace desher\expertsender\methods;

use desher\expertsender\mappers;

class Tables extends AbstractMethod
{
    /**
     * Add a row to table
     * @param $tableName
     * @param $rowData
     * @return bool
     */
    public function addRow($tableName, $rowData)
    {
        $result = $this->connection->post('DataTablesAddRow', $this->getRowXml($tableName, $rowData));
        return $result['code'] === 201;
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
}