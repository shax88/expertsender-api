<?php

namespace PicodiLab\Expertsender\Method;

use PicodiLab\Expertsender\Mapper;

class Subscribers extends AbstractMethod
{
    const INFO_OPTION_FULL = 'Full';
    const INFO_OPTION_LONG = 'Long';
    const INFO_OPTION_SHORT = 'Short';
    const INFO_OPTION_EVENT_HISTORY = 'EventsHistory';

    const METHOD_SUBSCRIBERS = 'Subscribers';
    const METHOD_REMOVED_SUBSCRIBERS = 'RemovedSubscribers';
    const METHOD_SNOOZED_SUBSCRIBERS = 'SnoozedSubscribers';

    /**
     * Subscriber info
     * @param $email
     * @param string $option
     * @return Mapper\Subscriber|null
     */
    public function get($email, $option = self::INFO_OPTION_FULL)
    {
        $result = $this->connection->get('Subscribers', [
            'email' => $email,
            'option' => $option
        ]);

        if (isset($result['response']->ErrorMessage) && $result['response']->ErrorMessage->Code == "400") {
            return null;
        }

        return new Mapper\Subscriber($email, isset($result['response']->Data) ? (array) $result['response']->Data : []);
    }

    /**
     * Save subscriber to list
     * @param Mapper\Subscriber $subscriber
     * @param $listId
     * @return bool
     */
    public function save(Mapper\Subscriber $subscriber, $listId)
    {
        $result = $this->connection->post('Subscribers', $this->getSubscriberXml($subscriber, $listId));
        return $result['code'] === 201;
    }

    /**
     * Return xml-object with subscriber data (for send to save method)
     * @param Mapper\Subscriber $subscriber
     * @param $listId
     * @return \SimpleXMLElement
     */
    protected function getSubscriberXml(Mapper\Subscriber $subscriber, $listId)
    {
        $xml = $this->connection->getDefaultRequestXml();

        // enable detailed response
        $xml->addChild('ReturnData', 'true');
        // add Data node with subscriber fields
        $dataXml = $xml->addChild('Data');
        $dataXml->addAttribute('xmlns:xsi:type', 'Subscriber');
        $dataXml->addChild('Email', $subscriber->email);
        $dataXml->addChild('Firstname', $subscriber->firstname);
        $dataXml->addChild('ListId', $listId);

        // add Properties list for subscriber
        $xmlProperties = $dataXml->addChild('Properties');
        foreach ($subscriber->properties as $property) {

            $xmlProperty = $xmlProperties->addChild('Property');
            $xmlProperty->addChild('Id', $property->id);
            $xmlProperty->addChild('Type', $property->type);
            $xmlPropertyValue = $xmlProperty->addChild('Value', $property->value);
            $xmlPropertyValue->addAttribute('xmlns:xsi:type', 'xs:' . $property->type);
        }

        return $xml;
    }
}