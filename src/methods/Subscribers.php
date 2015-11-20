<?php

namespace desher\expertsender\methods;

class Subscribers extends AbstractMethod
{
    const INFO_OPTION_FULL = 'Full';
    const INFO_OPTION_LONG = 'Long';
    const INFO_OPTION_SHORT = 'Short';
    const INFO_OPTION_EVENT_HISTORY = 'EventsHistory';

    public function getInfo($email, $option = self::INFO_OPTION_FULL)
    {
        $info = $this->connection->get('Subscribers', [
            'email' => $email,
            'option' => $option
        ]);

        return $info;
    }
}