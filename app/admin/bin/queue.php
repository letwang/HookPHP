<?php
function callback($envelope, $queue)
{
    $msg = $envelope->getBody();
    $queue->nack($envelope->getDeliveryTag());
    
    echo $msg.PHP_EOL;
}

$connection = new AMQPConnection();
$connection->connect();

$channel = new AMQPChannel($connection);
$exchange = new AMQPExchange($channel);
$exchange->setName('exchange_name_001');
$exchange->setType(AMQP_EX_TYPE_DIRECT);
$exchange->declareExchange();
$queue = new AMQPQueue($channel);
$queue->setName('queue_name_001');
$queue->setFlags(AMQP_DURABLE);
$queue->declareQueue();
$queue->bind('exchange_name_001', 'routing.key');

if (!empty($_SERVER['argv'])) {
    while (true) {
        $queue->consume('callback');
    }
} else {
    echo $exchange->publish('Hello World!'.date('Y-m-d H:i:s'), 'routing.key');
}

$connection->disconnect();