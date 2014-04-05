<?php

namespace FindDotTorrent;

/**
 * A client is responsible for returning the raw content from the specified
 * url.
 */
interface Client
{
    /**
     * @param string $url The url to retrieve the content from
     * @return string The raw content at the specified url
     */
    public function get($url);
}