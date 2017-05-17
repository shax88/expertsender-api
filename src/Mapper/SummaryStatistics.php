<?php


namespace PicodiLab\Expertsender\Mapper;


class SummaryStatistics implements \Iterator
{

    /**
     * @var SummaryStatistic[]
     */
    private $summaryStatistics = [];

    /**
     * SummaryStatistics constructor.
     * @param \SimpleXMLElement $data
     */
    public function __construct(\SimpleXMLElement $data)
    {
        foreach ($data as $summaryStatisticData) {
            $this->summaryStatistics[] = new SummaryStatistic($summaryStatisticData);
        }
    }

    /**
     * @return SummaryStatistic[]
     */
    public function getSummaryStatistics()
    {
        return $this->summaryStatistics;
    }

    /**
     * @return mixed|SummaryStatistic
     */
    public function current()
    {
        return current($this->summaryStatistics);
    }

    /**
     * @return mixed|SummaryStatistic
     */
    public function next()
    {
        return next($this->summaryStatistics);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->summaryStatistics);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return isset($this->summaryStatistics[$this->current()]);
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->summaryStatistics);
    }


}