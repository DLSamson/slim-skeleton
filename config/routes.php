<?php

use DocsWorker\Controllers\IndexController;
use DocsWorker\Kernel;

return function (Slim\App $app) {
    $app->get('/', IndexController::class);
};