<?php
use DocsWorker\Kernel;

require_once '../config/bootstrap.php';
require_once '../vendor/autoload.php';

$kernel = new Kernel();
$kernel->run();