<?php

namespace PicodiLab\Expertsender\Method;

use GuzzleHttp\Psr7\Response;
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

    protected $mapperName = 'Subscriber';

    /**
     * Subscriber info
     * @param $email
     * @param string $option
     * @return Mapper\Subscriber|null
     */
    public function get($email, $option = self::INFO_OPTION_FULL, $mapCustomFields = true)
    {
        $response = $this->connection->get('Subscribers', [
            'apiKey' => $this->connection->getKey(),
            'email' => $email,
            'option' => $option,
        ]);

        $this->connection->isResponseValid($response);

        $rXml = $this->connection->prepareResponse($response);

        return new Mapper\Subscriber($email, isset($rXml->Data) ? (array)$rXml->Data : []);
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