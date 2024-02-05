<?php

namespace DocsWorker;

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use DocsWorker\Commands\RouteListCommand;
use DocsWorker\Commands\RunServerCommand;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Slim\App;

final class Kernel {
    public function commands() : Collection {
        return collect([
            RunServerCommand::class,
            RouteListCommand::class,
        ]);
    }

    public function getApp() : App {
        /** @var array */
        $dependenciesDefinitions = require_once PATH_CONFIG . '/container.php';
        /** @var callable */
        $routesDefinitions = require_once PATH_CONFIG .'/routes.php';
        /** @var callable */
        $middlewaresDefinitions = require_once PATH_CONFIG .'/middlewares.php';

        $builder = new ContainerBuilder();
        $builder->addDefinitions($dependenciesDefinitions);
        $builder->useAutowiring(true);
        $builder->useAttributes(true);

        $container = $builder->build();
        $app = Bridge::create($container);

        $routesDefinitions($app);
        $middlewaresDefinitions($app);

        $app->addBodyParsingMiddleware();
        $app->addErrorMiddleware(true, true, true, $container->get(LoggerInterface::class));

        return $app;
    }

    private function handleRequest() : void {
        $app = $this->getApp();

        $app->run();
    }

    private function executeCommand() : void {
        $app = new Application();
        $app->addCommands($this
            ->commands()
            ->map(fn($command) => new $command())
            ->toArray());
        $app->run();
    }

    public function run() : void {
        php_sapi_name() == "cli"
            ? $this->executeCommand()
            : $this->handleRequest();
    }
}