<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Mapper;

class Statistics extends AbstractMethod
{

    const METHOD_LinkStatistics = 'LinkStatistics';
    const METHOD_MessageStatistics = 'MessageStatistics';
    const METHOD_VendorStatistics = 'VendorStatistics';
    const METHOD_SummaryStatistics = 'SummaryStatistics';
    const METHOD_ImportReports = 'ImportReports';
    const METHOD_SubscriberStatistics = 'SubscriberStatistics';
    const METHOD_SplitTestStatistics = 'SplitTestStatistics';

    protected $mapperName = null;

    public function get($id)
    {
        $response = $this->connection->get(self::METHOD_MessageStatistics . '/' . $id, [
            'apiKey' => $this->connection->getKey(),
        ]);

        $this->connection->isResponseValid($response);
        $rXml = $this->connection->prepareResponse($response);

        return new Mapper\MessageStatistics(isset($rXml->Data) ? (array)$rXml->Data : []);
    }

}