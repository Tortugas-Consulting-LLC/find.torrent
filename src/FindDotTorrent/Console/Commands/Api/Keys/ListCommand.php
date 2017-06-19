<?php

namespace FindDotTorrent\Console\Commands\Api\Keys;

use FindDotTorrent\App;
use FindDotTorrent\Key;
use FindDotTorrent\KeyHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Command
{
    protected $app;

    protected function configure()
    {
        $this->setName('api-key:list')
            ->setDescription('List all registered API keys.');
    }

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

        $keys = $dbal->findAll();

        if (empty($keys)) {
            $output->writeLn("<error>No keys configured.</error>");
            return;
        }

        $output->writeLn(sprintf('+%1$\'-4s+%1$\'-66s+%1$\'-66s+', "-"));
        $output->writeLn(sprintf('| %-3s| %-65s| %-65s|', "ID", "Public Key", "Private Key"));
        $output->writeLn(sprintf('+%1$\'-4s+%1$\'-66s+%1$\'-66s+', "-"));
        foreach ($keys as $key) {
            /** @var Key $key */
            $output->writeLn(sprintf('|<info>%3s</info> | <info>%-65s</info>| <info>%-65s</info>|', $key->getId(),
                $key->getPublicKey(), $key->getPrivateKey()));
        }
        $output->writeLn(sprintf('+%1$\'-4s+%1$\'-66s+%1$\'-66s+', "-"));
    }
}
