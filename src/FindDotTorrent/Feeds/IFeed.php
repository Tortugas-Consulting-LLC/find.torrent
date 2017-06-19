<?php

namespace FindDotTorrent\Feeds;

interface IFeed
{
    // Getters for basic information about this feed
    public function getIdentifier();

    public function getName();

    public function getEnabled();

    public function getUrl();

    // Functions used in RSS parsing
    public function makeSearchUrl($term);

    public function fetchResults($response);
}
