<?php

require __DIR__ . '/vendor/autoload.php';

$app = new FindDotTorrent\App();

echo $app->run(new Bullet\Request());
