<?php
$app->path('/', function($request) use($app) {
    $app->filter('authenticate');

    $data = array('welcome' => $app['welcome_msg']);

    $hal = new \Nocarrier\Hal('/', $data);
    $app['HalHandler']->addMyCurie($hal);

    $hal->addLink('ft:about', '/about/');
    $hal->addLink('ft:feeds', '/feeds/');
    $hal->addLink('ft:search', '/search/{?term}', array('templated' => true));

    return $hal;
});
