<?php
namespace FindDotTorrent\Console\Commands\Api\Keys;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateCommand extends Command
{
    protected $app;

    protected function configure()
    {
        $this->setName('api-key:create')
            ->setDescription('Generates a new API key.');
    }

    public function addApp(\FindDotTorrent\App $app)
    {
        $this->app = $app;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dbal = $this->app['KeyHandler'];
        $key = $dbal->generate();
        $dbal->persist($key);

        $output->writeLn("<info>Your API key has been generated.</info>");
        $output->writeLn(sprintf("New public key is  : <info>%s</info>", $key->getPublicKey()));
        $output->writeLn(sprintf("New private key is : <info>%s</info>", $key->getPrivateKey()));
    }
}
