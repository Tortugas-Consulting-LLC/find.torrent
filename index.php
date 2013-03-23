<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . 'app.php';
echo $app->run(new Bullet\Request());
