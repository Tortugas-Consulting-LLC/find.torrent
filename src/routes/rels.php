<?php
$app->path('/rels/', function($request) use($app) {
    // Helper closure so I don't have to repeat myself
    $makeTemplate = function($rel) use ($app) {
        return $app->template($rel)
            ->set(array(
               'rel' => $rel,
            ))
            ->layout('rels')
            ->format('md')
            ->status(200);
    };

    $app->param('slug', function($request, $rel) use($app, $makeTemplate) {
        // Render doc for $rel
        return $makeTemplate($rel);
    });

    // Default view for if you just come to /rels/
    return $makeTemplate('home');
});
