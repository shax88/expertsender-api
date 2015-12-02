ExpertSender API client
=================

PHP client for ExpertSender API

## Usage

```php
$expertSender = new ExpertSenderApi($apiKey);

$subscriber = new mappers\Subscriber('subscriber@email.com');
$subscriber
        ->setFirstname('Tester')
        ->addProperty(1, mappers\Property::TYPE_BOOLEAN, true);

$success = $expertSender->getSubscribers()->save($subscriber, $listId);

if ($success) {
    $subscriber = $expertSender->getSubscribers()->get('subscriber@email.com');

    $expertSender->getTables()->addRow('orders', [
        'subscriber_id' => $subscriber->getId(),
        'product_id' => $productId,
    ]);
}

```
