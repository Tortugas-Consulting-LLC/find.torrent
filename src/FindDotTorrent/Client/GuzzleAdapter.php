<?php

namespace FindDotTorrent\Client;

/**
 * A simple client adapter wrapping the populate GuzzleHttp\Client
 */
class GuzzleAdapter implements \FindDotTorrent\Client
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Fetch the raw content from the specified URL
     *
     * @param string $url The url to fetch content from
     * @return string The raw request content
     */
    public function get($url)
    {
        $response = $this->client->get($url);

        return $response->getBody();
    }
}