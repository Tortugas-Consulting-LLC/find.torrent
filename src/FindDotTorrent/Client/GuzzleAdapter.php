<?php

namespace FindDotTorrent\Client;

class GuzzleAdapter implements \FindDotTorrent\Client
{
    protected $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    public function get($url)
    {
        $response = $this->client->get($url);

        return $response->getBody();
    }
}