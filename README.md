ExpertSender API client
=================

PHP client for ExpertSender API

## Usage

```php
$apiKey = ''; // your api key
$expertSender = new ExpertSenderApi($apiKey);

# lists management:

$lists = $expertSender->Lists();
// $lists->create('testList');

$subscribers = $expertSender->Subscribers();
// $testSubscriber = $subscribers->get('someone.test@email.com');


$dataTableRows = $expertSender->DataTables()->getData('testTable', ['columns' => ['column1', 'column2']]);

// $activities
// fields
// lists
// segments

// all above working in a very similar way.

```
