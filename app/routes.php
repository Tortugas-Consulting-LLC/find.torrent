<?php

$app->get('/api/feeds/', 'feed.controller:all');
$app->put('/api/feeds/{feed}', 'feed.controller:setStatus');

$app->get('/api/search/{term}', 'search.controller:all');
$app->get('/api/search/{feed}/{term}', 'search.controller:one');

$app->put('/api/download/', 'download.controller:download');
