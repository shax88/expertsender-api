<?php

namespace desher\expertsender\methods;

use desher\expertsender\mappers;

class Subscribers extends AbstractMethod
{
    const INFO_OPTION_FULL = 'Full';
    const INFO_OPTION_LONG = 'Long';
    const INFO_OPTION_SHORT = 'Short';
    const INFO_OPTION_EVENT_HISTORY = 'EventsHistory';

    /**
     * Subscriber info
     * @param $email
     * @param string $option
     * @return mappers\Subscriber|null
     */
    public function get($email, $option = self::INFO_OPTION_FULL)
    {
        $response = $this->connection->get('Subscribers', [
            'email' => $email,
            'option' => $option
        ]);

        if (isset($response->ErrorMessage) && $response->ErrorMessage->Code == "400") {
            return null;
        }

        return new mappers\Subscriber($response);
    }

    /**
     * Create new subscriber
     * @param mappers\Subscriber $subscriber
     * @return bool
     */
    public function create(mappers\Subscriber $subscriber)
    {
        return $this->save($subscriber);
    }

    /**
     * Update subscriber
     * @param mappers\Subscriber $subscriber
     * @return bool
     */
    public function update(mappers\Subscriber $subscriber)
    {
        return $this->save($subscriber);
    }

    protected function save(mappers\Subscriber $subscriber)
    {
        $response = $this->connection->post('Subscribers', $subscriber->toArray());

        return true;
    }
}