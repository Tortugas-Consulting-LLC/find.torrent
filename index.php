<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/app.inc.php';
echo $app->run(new Bullet\Request());
