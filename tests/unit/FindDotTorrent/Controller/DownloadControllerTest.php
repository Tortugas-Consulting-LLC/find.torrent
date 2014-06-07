<?php

use Symfony\Component\HttpFoundation\Request;

class DownloadControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanDownloadSuccessfully()
    {
        $url = 'http://example.com/file/id/12345';
        $request = new Request([], ['url' => $url]);
        $downloadPath = '/path/to/download';

        $client = $this->getMockClient($url, $downloadPath, true);

        $controller = new \FindDotTorrent\Controller\DownloadController($client, $downloadPath);

        $response = $controller->download($request);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testFailedDownloadReturnsCorrectResponse()
    {
        $url = 'http://example.com/file/id/12345';
        $request = new Request([], ['url' => $url]);
        $downloadPath = '/path/to/download';

        $client = $this->getMockClient($url, $downloadPath, false);

        $controller = new \FindDotTorrent\Controller\DownloadController($client, $downloadPath);

        $response = $controller->download($request);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    protected function getMockClient($url, $downloadPath, $returnValue)
    {
        $client = $this->getMock('FindDotTorrent\Client');
        $client->expects($this->once())
               ->method('download')
               ->with(
                   $url,
                   $this->stringContains($downloadPath)
               )
               ->will($this->returnValue($returnValue));

        return $client;
    }
}