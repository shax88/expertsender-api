<?php

namespace PicodiLab\Expertsender\Mapper;


class SummaryStatisticsTest extends \PHPUnit_Framework_TestCase
{

    public function testCreatingSummaryStatistics()
    {
        $xml = simplexml_load_file(__DIR__ . '/../../data/summary_statistics.xml');
        $summaryStatistics = new SummaryStatistics($xml->Data);
        $this->assertAttributeContainsOnly(SummaryStatistic::class, 'summaryStatistics', $summaryStatistics);
    }

    public function testIfItWorksAsIterator()
    {
        $xml = simplexml_load_file(__DIR__ . '/../../data/summary_statistics.xml');
        $summaryStatistics = new SummaryStatistics($xml->Data);
        foreach ($summaryStatistics as $summaryStatistic) {
            $this->assertInstanceOf(SummaryStatistic::class, $summaryStatistic);
        }
    }
}
