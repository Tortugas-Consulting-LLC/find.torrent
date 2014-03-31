#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use FindDotTorrent\Console\Commands\Api\Keys\CreateCommand;
use FindDotTorrent\Console\Commands\Api\Keys\ListCommand;
use FindDotTorrent\Console\Commands\Api\Keys\DeleteCommand;
use Symfony\Component\Console\Application;

$app = new FindDotTorrent\App();

$create = new CreateCommand();
$create->addApp($app);
$list = new ListCommand();
$list->addApp($app);
$delete = new DeleteCommand();
$delete->addApp($app);

$console = new Application();
$console->add($create);
$console->add($list);
$console->add($delete);
$console->run();
