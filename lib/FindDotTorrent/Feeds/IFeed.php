<?php

namespace FindDotTorrent\Feeds;

interface IFeed {
    public function getUrl($term);
    public function fetchResults($response);
}
