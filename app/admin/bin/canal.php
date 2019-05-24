<?php
require __DIR__.'/../init.php';
require __DIR__.'/../../../bin/install.php';

use Hook\Db\RedisConnect;

$connection = new AMQPConnection();
$connection->connect();

$channel = new AMQPChannel($connection);

$queue = new AMQPQueue($channel);
$queue->setName('canal.admin');
$queue->setFlags(AMQP_NOPARAM);
$queue->declareQueue();
$queue->bind('canal');

$redis = RedisConnect::getInstance()->handle;

$queue->consume(function ($envelope, $queue) use ($redis) {
    $data = json_decode($envelope->getBody(), true);
    if ($data['db'] === APP_CONFIG['mysql']['default']['dbname']) {
        synData($data, $redis);
    }
    $queue->nack($envelope->getDeliveryTag());
});