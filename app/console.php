<?php

require __DIR__ . '/../vendor/autoload.php';
$config = require __DIR__ . '/config/config.php';

use Doctrine\DBAL\DriverManager;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

$db = DriverManager::getConnection($config['db']);

$helperSet = new HelperSet(
    array(
        'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($db),
        'dialog' => new \Symfony\Component\Console\Helper\DialogHelper(),
    )
);

$console = new Application();
$console->setHelperSet($helperSet);
$console->addCommands(
    array(
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\DiffCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\ExecuteCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\GenerateCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\StatusCommand(),
        new \Doctrine\DBAL\Migrations\Tools\Console\Command\VersionCommand()
    )
);

$console->run();