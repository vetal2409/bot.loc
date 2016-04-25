<?php
/**
 * Author: Vitalii Sydorenko <vetal.sydo@gmail.com>
 */

$config = require_once __DIR__ . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../config/main.php';
spl_autoload_register($config['autoload']);

use components\Monitoring;

$monitoring = new Monitoring($config['monitoring']);
$monitoring->run();
