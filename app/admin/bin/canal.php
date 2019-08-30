<?php
require __DIR__ . '/../Init.php';
require __DIR__.'/../../../bin/install.php';

use Hook\Db\{OrmConnect};

$connection = new AMQPConnection();
$connection->connect();

$channel = new AMQPChannel($connection);

$queue = new AMQPQueue($channel);
$queue->setName('canal.admin');
$queue->setFlags(AMQP_NOPARAM);
$queue->declareQueue();
$queue->bind('canal');

$queue->consume(function ($envelope, $queue) {
    $data = json_decode($envelope->getBody(), true);
    if ($data['db'] === APP_CONFIG['mysql']['default']['dbname']) {
        OrmConnect::flush($data['table']);
    }
    $queue->nack($envelope->getDeliveryTag());
});