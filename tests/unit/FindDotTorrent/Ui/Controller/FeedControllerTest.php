<?php

use Symfony\Component\HttpFoundation\Request;

class FeedControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $repo;

    public function setUp()
    {
        $this->repo = $this->getMockBuilder('\FindDotTorrent\Repository\Feeds')
                           ->disableOriginalConstructor()
                           ->getMock();
    }

    public function testCanGetAll()
    {
        $kaFeed = $this->getMock('\FindDotTorrent\Feed');
        $miniFeed = $this->getMock('\FindDotTorrent\Feed');

        $this->repo->expects($this->once())
                   ->method('all')
                   ->will($this->returnValue(array($kaFeed, $miniFeed)));

        $controller = new \FindDotTorrent\Ui\Controller\FeedController($this->repo);

        $response = $controller->all();

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanSetStatus()
    {
        $feed = $this->getMock('\FindDotTorrent\Feed');

        $this->repo->expects($this->once())
                   ->method('get')
                   ->with('KickAss')
                   ->will($this->returnValue($feed));

        $this->repo->expects($this->once())
                   ->method('setStatus')
                   ->with($feed, true);

        $request = new Request([], ['enabled' => true]);

        $controller = new \FindDotTorrent\Ui\Controller\FeedController($this->repo);
        $response = $controller->setStatus($request, 'KickAss');

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(204, $response->getStatusCode());

    }

    public function testCannotSetStatusOnNonExistentFeed()
    {
        $this->repo->expects($this->once())
                   ->method('get')
                   ->with('KickAss')
                   ->will($this->returnValue(false));

        $request = new Request([], ['enabled' => true]);

        $controller = new \FindDotTorrent\Ui\Controller\FeedController($this->repo);
        $response = $controller->setStatus($request, 'KickAss');

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }
}