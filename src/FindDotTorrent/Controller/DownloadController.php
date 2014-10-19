<?php

namespace FindDotTorrent\Controller;

use FindDotTorrent\Domain;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DownloadController
{
    /**
     * @var Domain\Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $downloadPath;

    /**
     * @param Domain\Client $client
     * @param string $downloadPath
     */
    public function __construct(Domain\Client $client, $downloadPath)
    {
        $this->client = $client;
        $this->downloadPath = $downloadPath;
    }

    /**
     * @param Request $request
     */
    public function download(Request $request)
    {
        $url = $request->get('url');
        $saveAs = $this->downloadPath . DIRECTORY_SEPARATOR . uniqid(rand(), true) . '.torrent';

        $result = $this->client->download($url, $saveAs);

        if (false === $result) {
            return new JsonResponse(array('error' => 'The requested torrent could not be downloaded.'), 400);
        }

        return new JsonResponse(['location' => $saveAs], 201);
    }
}