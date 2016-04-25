<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */

$config = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/main.php';
spl_autoload_register($config['autoload']);

use components\DropBoxUploader;
use components\PheanstalkQueueFactory;
use components\Uploader;

$factory = new PheanstalkQueueFactory();
$queueUpload = $factory->make('upload');
$queueDone = $factory->make('done');
$queueFailed = $factory->make('failed');

$resizer = new Uploader($queueUpload, $queueDone, $queueFailed);
$limit = isset($argv[2], $argv[3]) && $argv[2] === '-n' ? (int)$argv[3] : 0;
$cloudUploader = new DropBoxUploader();
$count = $resizer->run($cloudUploader, $limit);

echo "*******RESULT***********\n";
echo "\tUploaded and move to 'done' queue: ${count} items.\n";
echo "************************\n";
