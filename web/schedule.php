<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */

$config = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/main.php';
spl_autoload_register($config['autoload']);

use components\PheanstalkQueueFactory;
use components\Scheduler;

$factory = new PheanstalkQueueFactory();
$queueResize = $factory->make('resize');
$scheduler = new Scheduler($config['scheduler'], $queueResize);
$count = $scheduler->run($argv[1]);
echo "*******RESULT***********\n";
echo "\tAdded to 'resize' queue: ${count} items.\n";
echo "************************\n";
