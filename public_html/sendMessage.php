<?php
require '../vendor/autoload.php';

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use Kreait\Firebase\Messaging\Notification;

$factory = (new Factory())
	    ->withServiceAccount('../notifyme-ab406-642d288bd903.json');

$messaging = $factory->createMessaging();

$message = CloudMessage::withTarget('topic', 'bigSales')
	    ->withNotification(Notification::create('Big Sale', 'A new big sale was just recorded!'))
	        ->withData(['message' => 'A new big sale was just recorded!']);

try {
    $messaging->validate($message);
} catch (InvalidMessage $e) {
    print_r($e->errors());
    exit;
}
$messaging->send($message);



?>
