<?php
use PicodiLab\Expertsender\ExpertSenderApi;
use PicodiLab\Expertsender\Mapper\SummaryStatistics;

require 'credentials.php'; //define API_KEY and API_URL here

class GetSummaryStatisticsTest extends \PHPUnit_Framework_TestCase
{


    public function testGettingStats()
    {
        $expertSender = new ExpertSenderApi(API_KEY, API_URL);
        $stats = $expertSender->Statistics();
        $summaryStats = $stats->getSummaryStatistics();
        $this->assertInstanceOf(SummaryStatistics::class, $summaryStats);
    }

    public function testGrouping()
    {
        $expertSender = new ExpertSenderApi(API_KEY, API_URL);
        $stats = $expertSender->Statistics();
        $summaryStats = $stats->getSummaryStatistics(null, null, null, null, 'Month');
        $this->assertInstanceOf(SummaryStatistics::class, $summaryStats);

        foreach ($summaryStats as $summaryStat) {
            if ($summaryStat->isSummaryRow()) {
                continue;
            }
            $this->assertInstanceOf(\DatePeriod::class, $summaryStat->getMonth());
        }
    }

}