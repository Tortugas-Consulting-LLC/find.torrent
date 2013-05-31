<?php
$app->path('feeds', function($request) use($app) {
    $make_feed_hal = function($feed) use($app) {
        $feed_hal = new \Nocarrier\Hal('/feeds/' . $feed->getIdentifier(), array(
            "name"    => $feed->getName(),
            "url"     => $feed->getUrl(),
            "enabled" => $feed->getEnabled()
        ));
        $app['HalHandler']->addMyCurie($feed_hal);
        $feed_hal->addLink('self', '/feeds/' . $feed->getIdentifier());

        return $feed_hal;
    };

    // When specifying a particular feed handle GET and PUT
    $app->param('slug', function($request, $feed_id) use ($app, $make_feed_hal) {
        $feed = $app->getFeedHandler()->findBy($feed_id);
        if (false === $feed) {
            return $app->response(404, "Feed {$feed_id} not found.");
        }

        $app->put(function($request) use($app, $feed, $make_feed_hal) {
            $feed->setEnabled($request->get("enabled"));
            $app->getFeedHandler()->persist($feed);
            return $make_feed_hal($feed);
        });

        $app->get(function($request) use($app, $feed, $make_feed_hal) {
            return $make_feed_hal($feed);
        });
    });

    // Begin response for straight calls to /feeds/
    $hal = new \Nocarrier\Hal('/feeds/');
    $app['HalHandler']->addMyCurie($hal);

    $hal->addLink('self', '/feeds/');
    $hal->addLink('ft:home', '/');
    $hal->addLink('ft:search', '/feeds/search/{?term}', array('templated' => true));

    foreach($app->getFeedHandler()->findAll() as $feed) {
        $hal->addResource('ft:feed', $make_feed_hal($feed));
    }

    return $hal;
});
