<?php

namespace PicodiLab\Expertsender\Mapper;

class MessageStatistics
{
    protected $sent;
    protected $bounced;
    protected $delivered;
    protected $opens;
    protected $uniqueOpens;
    protected $clicks;
    protected $uniqueClicks;
    protected $clickers;
    protected $complaints;
    protected $unsubscribes;

    /**
     * @param mixed $data
     */
    public function __construct($data = [])
    {
        if (isset($data['Sent'])) {
            $this->setSent($data['Sent']);
        }
        if (isset($data['Bounced'])) {
            $this->setBounced($data['Bounced']);
        }
        if (isset($data['Delivered'])) {
            $this->setDelivered($data['Delivered']);
        }
        if (isset($data['Opens'])) {
            $this->setOpens($data['Opens']);
        }
        if (isset($data['UniqueOpens'])) {
            $this->setUniqueOpens($data['UniqueOpens']);
        }
        if (isset($data['Clicks'])) {
            $this->setClicks($data['Clicks']);
        }
        if (isset($data['UniqueClicks'])) {
            $this->setUniqueClicks($data['UniqueClicks']);
        }
        if (isset($data['Clickers'])) {
            $this->setClickers($data['Clickers']);
        }
        if (isset($data['Complaints'])) {
            $this->setComplaints($data['Complaints']);
        }
        if (isset($data['Unsubscribes'])) {
            $this->setUnsubscribes($data['Unsubscribes']);
        }
    }

    public function setSent($value)
    {
        $this->sent = $value;
        return $this;
    }

    public function setBounced($value)
    {
        $this->bounced = $value;
        return $this;
    }

    public function setDelivered($value)
    {
        $this->delivered = $value;
        return $this;
    }

    public function setOpens($value)
    {
        $this->opens = $value;
        return $this;
    }

    public function setUniqueOpens($value)
    {
        $this->uniqueOpens = $value;
        return $this;
    }

    public function setClicks($value)
    {
        $this->clicks = $value;
        return $this;
    }

    public function setUniqueClicks($value)
    {
        $this->uniqueClicks = $value;
        return $this;
    }

    public function setClickers($value)
    {
        $this->clickers = $value;
        return $this;
    }

    public function setComplaints($value)
    {
        $this->complaints = $value;
        return $this;
    }

    public function setUnsubscribes($value)
    {
        $this->unsubscribes = $value;
        return $this;
    }

    public function getSent()
    {
        return $this->sent;
    }

    public function getBounced()
    {
        return $this->bounced;
    }

    public function getDelivered()
    {
        return $this->delivered;
    }

    public function getOpens()
    {
        return $this->opens;
    }

    public function getUniqueOpens()
    {
        return $this->uniqueOpens;
    }

    public function getClicks()
    {
        return $this->clicks;
    }

    public function getUniqueClicks()
    {
        return $this->uniqueClicks;
    }

    public function getClickers()
    {
        return $this->clickers;
    }

    public function getComplaints()
    {
        return $this->complaints;
    }

    public function getUnsubscribes()
    {
        return $this->unsubscribes;
    }
}
