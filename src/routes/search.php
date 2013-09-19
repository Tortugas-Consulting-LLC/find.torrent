<?php
$app->path('/search', function($request) use($app) {
    $app->filter('authenticate');

    $app->param('slug', function ($request, $term) use ($app) {
        $results = array();
        $hal = new \Nocarrier\Hal('/search');

        foreach($app->getFeedHandler()->findAll() as $feed) {
            $feed_results = \FindDotTorrent\Feeds\Fetch::fetchResults($term, $feed);
            foreach($feed_results as $result) {
                $hal->addLink('ft:torrent', '/download/', array(
                    'title' => $result->getTitle(),
                    'target' => $result->getLink()
                ));
            }
        }

        $app['HalHandler']->addMyCurie($hal);

        $hal->addLink('self', '/search/{?term}', array('templated' => true));
        $hal->addLink('ft:home', '/');
        $hal->addLink('ft:feeds', '/feeds/');

        return $hal;
    });
});
