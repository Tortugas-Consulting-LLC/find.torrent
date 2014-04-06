<?php

class SearchControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testCanSearchAll()
    {
        $kaFeed = $this->getMockFeed('Kick Ass', 'http://kickass.to', 'Kick Ass');
        $miniFeed = $this->getMockFeed('Mininova', 'http://mininova.org', 'Mininova');

        $repo = $this->getMockBuilder('\FindDotTorrent\Repository\Feeds')
                     ->disableOriginalConstructor()
                     ->getMock();
        $repo->expects($this->once())
             ->method('getEnabled')
             ->will($this->returnValue(array($kaFeed, $miniFeed)));

        $controller = new \FindDotTorrent\Controller\SearchController($repo);

        $response = $controller->all('12 Angry Men');

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testCanSearchOne()
    {
        $feed = $this->getMockFeed('Kick Ass', 'http://kickass.to', 'Kick Ass');

        $repo = $this->getMockBuilder('\FindDotTorrent\Repository\Feeds')
                     ->disableOriginalConstructor()
                     ->getMock();
        $repo->expects($this->once())
             ->method('get')
             ->with('KickAss')
             ->will($this->returnValue($feed));

        $controller = new \FindDotTorrent\Controller\SearchController($repo);

        $response = $controller->one('KickAss', '12 Angry Men');

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testNonExistentFeedSearchFails()
    {
        $repo = $this->getMockBuilder('\FindDotTorrent\Repository\Feeds')
                     ->disableOriginalConstructor()
                     ->getMock();
        $repo->expects($this->once())
             ->method('get')
             ->with('non-existent-feed')
             ->will($this->returnValue(false));

        $controller = new \FindDotTorrent\Controller\SearchController($repo);

        $response = $controller->one('non-existent-feed', '12 Angry Men');

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\JsonResponse', $response);
        $this->assertEquals(400, $response->getStatusCode());
    }

    protected function getMockFeed($title, $link, $label)
    {
        $item = new \FindDotTorrent\Item($title, $link);
        $item->setLabel($label);

        $feed = $this->getMock('\FindDotTorrent\Feed');
        $feed->expects($this->once())
               ->method('search')
               ->will($this->returnValue(array($item)));

        return $feed;
    }
}