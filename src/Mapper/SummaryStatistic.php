<?php


namespace PicodiLab\Expertsender\Mapper;


class SummaryStatistic
{

    /**
     * @var bool
     * If set to true, marks the summary row of statistic table (values are sums of all other rows).
     */
    private $isSummaryRow;
    /**
     * @var \DateTime|null
     * Date. Returned only if grouping by dates was requested.
     */
    private $date;
    /**
     * @var \DateTime|null
     * Month represented as date period. Returned only if grouping by months was requested.
     */
    private $month;
    /**
     * @var int|null
     * Message ID. Returned only if grouping by messages was requested.
     */
    private $messageId;
    /**
     * @var string|null
     * Message subject. Returned only if grouping by messages was requested.
     */
    private $messageSubject;
    /**
     * @var int|null
     * Subscriber list ID. Returned only if grouping by lists was requested.
     */
    private $listId;
    /**
     * @var string|null
     * Subscriber list name. Returned only if grouping by lists was requested.
     */
    private $listName;
    /**
     * @var int|null
     * Subscriber segment ID. Returned only if grouping by segments was requested and the row does not contain
     * data about unsegmented subscribers.
     */
    private $segmentId;
    /**
     * @var string|null
     * Subscriber segment name. Returned only if grouping by segments as requested.
     * If row contains data about unsegmented subscribers, it will return dash ("-") as value.
     */
    private $segmentName;
    /**
     * @var string|null
     * Channel IP address. Returned only if grouping by IPs was requested.
     */
    private $ip;
    /**
     * @var string|null
     * Domain name. Returned only if grouping by domains was requested.
     */
    private $domain;
    /**
     * @var string|null
     * Domain family name. Returned only if grouping by domain families was requested.
     */
    private $domainFamily;
    /**
     * @var string|null
     * Vendor name. Returned only if grouping by vendors was requested.
     * If row contains data about subscribers with no vendor, dash ("-") will be returned.
     */
    private $vendor;
    /**
     * @var int|null
     * Business goal ID. Returned only if grouping by business goals was requested.
     */
    private $goalId;
    /**
     * @var string|null
     * Business goal name. Returned only if grouping by business goals was requested.
     */
    private $goalName;
    /**
     * @var string|null
     * Send time optimization. Returned only if grouping by send time optimization was requested.
     * One of: "OptimizationNotUsed", "TimeOptimized", "TimeNotOptimized" or dash "-" if does not apply.
     */
    private $sendTimeOptimization;
    /**
     * @var string|null
     * Time travel optimization. Returned only if grouping by time travel optimization was requested.
     * One of: "OptimizationNotUsed", "TimeOptimized", "TimeNotOptimized" or dash "-" if does not apply.
     */
    private $timeTravelOptimization;
    /**
     * @var string|null
     * Reading environment. Returned only if grouping by reading environment was requested.
     * One of: "Other", "Desktop", "Mobile", "Webmail", "NoActivity" or dash "-" if does not apply.
     */
    private $readingEnvironment;
    /**
     * @var int
     * Number of sent emails.
     */
    private $sent;
    /**
     * @var int
     * Number of bounced emails.
     */
    private $bounced;
    /**
     * @var int
     * Number of delivered (sent - bounced) emails.
     */
    private $delivered;
    /**
     * @var int
     * Number of opened emails.
     */
    private $opens;
    /**
     * @var int
     * Number of opened emails by unique subscribers.
     */
    private $uniqueOpens;
    /**
     * @var int
     * Number of link clicks.
     */
    private $clicks;
    /**
     * @var int
     * Number of link clicks by unique subscribers.
     */
    private $uniqueClicks;
    /**
     * @var int
     * Number of unique subscribers that clicked any link.
     */
    private $clickers;
    /**
     * @var int
     * Number of spam complaints.
     */
    private $complaints;
    /**
     * @var int
     * Number of “unsubscribe” link clicks.
     */
    private $unsubscribes;
    /**
     * @var int
     * Number of achieved business goals.
     */
    private $goals;
    /**
     * @var int
     * Value of achieved business goals.
     */
    private $goalsValue;
    /**
     * @var \SimpleXMLElement
     */
    private $summaryStatisticData;

    /**
     * SummaryStatistic constructor.
     * @param $summaryStatisticData
     */
    public function __construct(\SimpleXMLElement $summaryStatisticData)
    {
        $this->summaryStatisticData = $summaryStatisticData;
        if (isset($this->summaryStatisticData->IsSummaryRow)) {
            $this->isSummaryRow = $this->summaryStatisticData->IsSummaryRow;
        } else {
            $this->isSummaryRow = false;
        }

        $this->setField('Date');
        $this->setField('Month');
        $this->setField('MessageId');
        $this->setField('MessageSubject');
        $this->setField('ListId');
        $this->setField('ListName');
        $this->setField('SegmentId');
        $this->setField('SegmentName');
        $this->setField('Ip');
        $this->setField('Domain');
        $this->setField('DomainFamily');
        $this->setField('Vendor');
        $this->setField('GoalId');
        $this->setField('GoalName');
        $this->setField('SendTimeOptimization');
        $this->setField('TimeTravelOptimization');
        $this->setField('ReadingEnvironment');
        $this->setField('Sent');
        $this->setField('Bounced');
        $this->setField('Delivered');
        $this->setField('Opens');
        $this->setField('UniqueOpens');
        $this->setField('Clicks');
        $this->setField('UniqueClicks');
        $this->setField('Clickers');
        $this->setField('Complaints');
        $this->setField('Unsubscribes');
        $this->setField('Goals');
        $this->setField('GoalsValue');

    }

    /**
     * @param string $xmlFieldName
     * @param \SimpleXMLElement $data
     */
    private function setField($xmlFieldName)
    {
        $propertyName = lcfirst($xmlFieldName);
        if (isset($this->summaryStatisticData->$xmlFieldName)) {
            $this->$propertyName = $this->summaryStatisticData->$xmlFieldName;
        } else {
            $this->$propertyName = null;
        }
    }

    /**
     * @return bool
     */
    public function isSummaryRow()
    {
        return $this->isSummaryRow;
    }

    /**
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return \DateTime|null
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return int|null
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return null|string
     */
    public function getMessageSubject()
    {
        return $this->messageSubject;
    }

    /**
     * @return int|null
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @return null|string
     */
    public function getListName()
    {
        return $this->listName;
    }

    /**
     * @return int|null
     */
    public function getSegmentId()
    {
        return $this->segmentId;
    }

    /**
     * @return null|string
     */
    public function getSegmentName()
    {
        return $this->segmentName;
    }

    /**
     * @return null|string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return null|string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return null|string
     */
    public function getDomainFamily()
    {
        return $this->domainFamily;
    }

    /**
     * @return null|string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @return int|null
     */
    public function getGoalId()
    {
        return $this->goalId;
    }

    /**
     * @return null|string
     */
    public function getGoalName()
    {
        return $this->goalName;
    }

    /**
     * @return null|string
     */
    public function getSendTimeOptimization()
    {
        return $this->sendTimeOptimization;
    }

    /**
     * @return null|string
     */
    public function getTimeTravelOptimization()
    {
        return $this->timeTravelOptimization;
    }

    /**
     * @return null|string
     */
    public function getReadingEnvironment()
    {
        return $this->readingEnvironment;
    }

    /**
     * @return int
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * @return int
     */
    public function getBounced()
    {
        return $this->bounced;
    }

    /**
     * @return int
     */
    public function getDelivered()
    {
        return $this->delivered;
    }

    /**
     * @return int
     */
    public function getOpens()
    {
        return $this->opens;
    }

    /**
     * @return int
     */
    public function getUniqueOpens()
    {
        return $this->uniqueOpens;
    }

    /**
     * @return int
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * @return int
     */
    public function getUniqueClicks()
    {
        return $this->uniqueClicks;
    }

    /**
     * @return int
     */
    public function getClickers()
    {
        return $this->clickers;
    }

    /**
     * @return int
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * @return int
     */
    public function getUnsubscribes()
    {
        return $this->unsubscribes;
    }

    /**
     * @return int
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @return int
     */
    public function getGoalsValue()
    {
        return $this->goalsValue;
    }

}