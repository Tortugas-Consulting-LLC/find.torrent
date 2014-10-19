<?php

namespace FindDotTorrent\Domain;

use FindDotTorrent\Feed;

interface FeedRepository
{
    /**
     * Retrieve all feeds, regardless of whether or not they are enabled
     *
     * @return array An array of Feed objects
     */
    public function all();

    /**
     * Retrieve all enabled feeds
     *
     * @return array An array of Feed objects
     */
    public function getEnabled();

    /**
     * Retrieve the requested feed
     *
     * @param string $feed The name of the feed to retrieve
     * @return Feed|false
     */
    public function get($label);

    /**
     * Set the status of the specified feed
     *
     * @param Feed $feed The feed to set the status on
     * @param bool $enabled A boolean to represent that status of the feed
     */
    public function setStatus(Feed $feed, $enabled);
}