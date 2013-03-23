<?php

$dir_config = __DIR__ . '/config';
$dir_routes = __DIR__ . '/routes';

$config = parse_ini_file($dir_config .'/config.ini');

$app = new Bullet\App($config);

foreach (glob($dir_routes . "/*.php") as $filename) {
    require $filename;
}
