<?php

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(
    new Silex\Provider\DoctrineServiceProvider(),
    array('db.options' => $config['db'])
);
