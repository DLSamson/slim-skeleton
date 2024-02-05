<?php

namespace DocsWorker\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Process\Process;

class RunServerCommand extends Command
{
    protected string $host = 'localhost';
    protected int $port = 8000;

    public function configure() {
        $this
            ->setName("serve")
            ->setDescription("Starts the server");
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $link = "{$this->host}:{$this->port}";
        $public_folder = PATH_ROOT.'/public';

        $output->writeln('Starting webserver on: http://' . $link);
        
        $process = new Process(['php', '-S', $link, '-t', $public_folder]);
        $process->start();

        while ($process->isRunning()) {
            usleep(500 * 1000);
        }

        $status = $process->getExitCode();

        if($status) {
            $output->writeln("Failed to start server on {$this->port}. Trying next port...");
            $this->port++;
            return $this->execute($input, $output);
        }

        return $status;
    }
}