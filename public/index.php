<?php

chdir(__DIR__ . '/../');

require 'vendor/autoload.php';

$config = require 'app/config/config.php';
$app = require 'app/app.php';

$app->run();