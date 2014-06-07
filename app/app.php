<?php

$app = new Silex\Application();

require __DIR__ . '/services.php';
require __DIR__ . '/middleware.php';
require __DIR__ . '/di.php';
require __DIR__ . '/controllers.php';
require __DIR__ . '/routes.php';

return $app;
