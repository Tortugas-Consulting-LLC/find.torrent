<?php

namespace FindDotTorrent\Console\Commands\Api\Keys;

use FindDotTorrent\App;
use FindDotTorrent\KeyHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DeleteCommand
 * @package FindDotTorrent\Console\Commands\Api\Keys
 */
class DeleteCommand extends Command
{
    /**
     * @var App
     */
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

    /**
     * @param App $app
     */
    public function addApp(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var KeyHandler $dbal */
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
