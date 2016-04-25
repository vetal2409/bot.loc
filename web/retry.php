<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */

$config = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/main.php';
spl_autoload_register($config['autoload']);

use components\PheanstalkQueueFactory;
use components\Retry;

$factory = new PheanstalkQueueFactory();
$queueFailed = $factory->make('failed');
$queueUpload = $factory->make('upload');

$retry = new Retry($queueFailed, $queueUpload);
$limit = isset($argv[2], $argv[3]) && $argv[2] === '-n' ? (int)$argv[3] : 0;
$count = $retry->run($limit);

echo "*******RESULT***********\n";
echo "\tMoved to 'upload' queue: ${count} items.\n";
echo "************************\n";
