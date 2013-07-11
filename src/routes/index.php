<?php
$app->path('/', function($request) use($app) {
    $data = array('welcome' => $app['welcome_msg']);

    $hal = new \Nocarrier\Hal('/', $data);
    $app['HalHandler']->addMyCurie($hal);

    $hal->addLink('ft:about', '/about/');
    $hal->addLink('ft:feeds', '/feeds/');
    $hal->addLink('ft:search', '/feeds/search/{?term}', array('templated' => true));

    return $hal;
});
