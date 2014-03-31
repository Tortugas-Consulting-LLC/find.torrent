<?php
namespace FindDotTorrent\Console\Commands\Api\Keys;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteCommand extends Command
{
    protected $app;

    protected function configure()
    {
        $this->setName('api-key:delete')
            ->setDescription('Deletes a configured API key.')
            ->addArgument(
                'id',
                InputArgument::REQUIRED,
                'The id of the key to delete as shown in the "ID" column of api-key:list.'
            );
    }

    public function addApp(\FindDotTorrent\App $app)
    {
        $this->app = $app;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dbal = $this->app['KeyHandler'];

        $id = $input->getArgument('id');

        // Find key based on input
        $key = $dbal->find($id);

        if (false === $key) {
            $output->writeLn("<error>Could not find a key with id {$id}</error>");
            return;
        }

        // Ask dbal to remove it
        $dbal->remove($key);

        $output->writeLn("<info>Key has been removed.</info>");
    }
}
