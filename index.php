<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/app.inc.php';
echo $app->run(new Bullet\Request());
