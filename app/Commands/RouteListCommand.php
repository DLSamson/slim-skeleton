<?php

namespace DocsWorker\Commands;

use Slim\Interfaces\RouteInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;
use DocsWorker\Kernel;

class RouteListCommand extends Command
{
    protected string $host = 'localhost';
    protected int $port = 8000;

    public function configure() {
        $this
            ->setName("route:list")
            ->setDescription("Prints the list of routes");
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $kernel = new Kernel();
        $app = $kernel->getApp();
        $routes = collect($app->getRouteCollector()->getRoutes())
            ->values()
            ->map(function (RouteInterface $route) {
                return [
                    implode(', ',$route->getMethods()),
                    $route->getPattern(),
                    $route->getName(),
                    is_array($route->getCallable()) 
                        ? implode('::', $route->getCallable()) 
                        : $route->getCallable(),
                ];
            })
            ->toArray();

        $table = new Table($output);
        $table
            ->setHeaders(["Method", "Path", "Name", "Handler"])
            ->setRows($routes);
        $table->render();

        return Command::SUCCESS;
    }
}