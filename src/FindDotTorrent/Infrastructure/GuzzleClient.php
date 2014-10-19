<?php

namespace FindDotTorrent\Infrastructure;

use FindDotTorrent\Domain;
use GuzzleHttp\Exception\RequestException;

/**
 * A simple client adapter wrapping the populate GuzzleHttp\Client
 */
class GuzzleClient implements Domain\Client
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

    /**
     * Download the contents of the specified URL to a given path
     *
     * @param string $url The url to fetch content from
     * @param string The location on disk where the file should be persisted
     *
     * @param bool Whether or not the download was successful
     */
    public function download($url, $saveAs)
    {
        try {
            $this->client->get(
                $url,
                [
                    'save_to' => $saveAs,
                    'config' => [
                        'curl' => [
                            CURLOPT_ENCODING => 'gzip',
                            CURLOPT_RETURNTRANSFER => 1
                        ]
                    ]
                ]
            );
        } catch (RequestException $e) {
            return false;
        }

        return true;
    }
}
