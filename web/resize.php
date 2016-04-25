<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */

$config = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/main.php';
spl_autoload_register($config['autoload']);

use components\PheanstalkQueue;
use components\PheanstalkQueueFactory;
use components\Resizer;

$factory = new PheanstalkQueueFactory();
$queueResize = $factory->make('resize');
$queueUpload = $factory->make('upload');
$resizer = new Resizer($config['resizer'], $queueResize, $queueUpload);
$limit = isset($argv[2], $argv[3]) && $argv[2] === '-n' ? (int)$argv[3] : 0;
$count = $resizer->run($limit);

echo "*******RESULT***********\n";
echo "\tResized and moved to 'upload' queue: ${count} items.\n";
echo "************************\n";
